<?php

    namespace App\Http\Controllers;

    use App\Models\Filter;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Illuminate\Support\Str;
    use Exception;
    use Carbon\Carbon;

    class BaseController extends Controller {
        public function __construct() {
            $this->route_name = Str::kebab(Str::studly($this->views));
        }

        public function index() {
           $this->authorize('index', $this->model);

            $data = $this->model::paginate(5);

            return view("{$this->views}.index")
                ->with($this->views, $data)
                ->with('obj_name', $this->views);
        }

        public function create($type = '') {
            $this->authorize('create', $this->model);

            $model = new $this->model();

            return view("{$this->views}.create")->with(Str::singular($this->views), $model);
        }

        public function store(Request $request) {
            $this->authorize('create', $this->model);

            if(!empty($this->model::$rules)) {
                $request->validate($this->model::$rules);
            }

            $data = $this->transact(function () {
                return $this->model::create(request()->all());
            });

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not saved, Something went wrong.');
            }

            //Add tags
            $tags = request()->tags;
            if($tags){
                foreach ($tags as $tag){
                    (new TagController())->createTags($this->model, $data->id, $tag);
                }
            }

            return redirect(route("{$this->route_name}.show",[$this->model => $data]))->with('success', 'Resource saved successfully.');
        }

        public function duplicate($id){
            $this->authorize('create', $this->model);
            $record = $this->model::find($id);
            $newRecord = $record->replicate();
            $newRecord->title = $newRecord->title.' (copy)';
            $newRecord->created_at = Carbon::now();
            $newRecord->save();
            if (empty($newRecord)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not duplicated, Something went wrong.');
            }

            return redirect(route("{$this->route_name}.index"))->with('success', 'Resource duplicated successfully.');
        }

        public function show($id) {
            if(!empty($_COOKIE['editmode'])) return self::edit($id);

            $data = $this->model::find($id);

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))
                    ->with('error', 'Resource not found');
            }

            $this->authorize('show', $data);

            return view("{$this->views}.show")
                ->with(Str::singular($this->views), $data);
        }

        public function view($id) {
            $data = $this->model::find($id);

            $this->authorize('view', $data);

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not found');
            }

            return view("{$this->views}.view")->with(Str::singular($this->views), $data);
        }

        public function edit($id) {
            $data = $this->model::find($id);

            $this->authorize('update', $data);

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not found');
            }

            return view("{$this->views}.edit")->with(Str::singular($this->views), $data);
        }

        public function update($id) {

            $data = $this->model::findOrFail($id);

            $this->authorize('update', $data);

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not found');
            }

            if (isset($this->update_request)) {
                $request = (new $this->update_request);
                request()->validate($request->rules(), $request->messages());
            }

            $this->transact(function () use ($data) {
                $updated = $data->update(request()->all());

                return $updated;
            });

            $keys = array_keys(request()->all());

            foreach ($keys as $key) {
                if (method_exists($data, $key) && is_callable([$data, $key])) {
                    $data->{$key}()->sync(request($key));
                }
            }
            return redirect(route("{$this->route_name}.show",[$data]))->with('success', 'Resource saved successfully.');
        }

        public function destroy($id) {
            $data = $this->model::find($id);

            $this->authorize('delete', $data);

            if (empty($data)) {
                return back()->with('error', 'Resource not found.');
            }

            $this->transact(function () use ($data) {
                return $data->delete();
            });

            //return back()->with('success', 'Resource deleted successfully.');

            return redirect(route("{$this->route_name}.index"))->with('success', 'Resource deleted successfully.');
        }

        public function confirm($id) {
            $data = $this->model::find($id);

            $this->authorize('delete', $data);

            if (empty($data)) {
                return back()->with('error', 'Resource not found.');
            }

            $this->transact(function () use ($data) {
                return $data->where('id', $data->id)->update(['status' => 'Confirmed']);
            });

            return back()->with('success', 'Resource confirmed successfully.');
        }

        protected function transact($fn) {
            $data = [];

            try {
                DB::beginTransaction();
                $data = $fn();
                DB::commit();
            } catch (Exception $ex) {
                DB::rollback();
                throw new Exception($ex);
            }

            return $data;
        }

        function globalSearchQuery($controller, $select, $where = []) {
            $relative_tables = [];
            $related_fields = [];
            $search_fields = [];
            $selectArray = [];
            foreach($select as $s) {
                $selectArray[] = $controller->table . '.' . $s;
            }
            foreach($controller->model::$relatedtables as $key => $value){
                $relative_tables[] = $key;
                $related_fields[$key] = $key. '.' .$value['related_field'];
                foreach($value['fields'] as $field){
                    $selectArray[] = $key. '.' .$field;
                    $search_fields[$key][] = $field;
                }
            }
            $theQ = $controller->model::select($selectArray)->where(function ($query) use($controller){
                    $query->where(function ($query)  use($controller){
                        foreach ($controller->model::$globalsearch as $key => $field) {
                            if(!in_array($key,$controller->model::$globalsearchavoid)){
                                $query->orWhere($controller->table . '.' . $key, 'like', '%' . request('keyword') . '%');
                            }
                        }
                    });
                });
            if(!empty($relative_tables)){
                foreach($relative_tables as $table){
                    $theQ->leftJoin($table,function($join) use($controller,$table, $related_fields) {
                        $join->on($related_fields[$table],'=',$controller->table.'.id');
                    })->orWhere(function ($query) use($controller, $search_fields, $table, $related_fields){
                        $query->orWhere(function ($query)  use($controller, $search_fields, $table, $related_fields){
                            foreach ($search_fields[$table] as $field) {
                                $query->orWhere($table . '.' . $field, 'like', '%' . request('keyword') . '%');
                            }
                        });
                    })->groupBy($related_fields[$table]);
                }
            }
            if($where) {
                foreach($where as $w) {
                    $theQ->where($controller->table . '.' . $w['this'], $w['operator'], $w['that']);
                }
            }
            return $theQ->distinct()->get();
        }

        public function globalSearch() {
            if (!empty(request("keyword"))) {
                echo '<ul id="search-results-list" class="card-body">';
                /* Users */
                $users = $this->globalSearchQuery(new UserController(), ['id', 'name', 'email'], '');
                /* SExample line of using where
                $users = $this->globalSearchQuery(new UserController(), ['name', 'email'], [0 => ['this' => '', 'operator' => '!=', 'that' => '']]);
                */
                $users = $users->sortBy('name')->values()->all();
                if($users){
                    echo '<li class="group"><ul><strong>Users</strong>';
                    foreach ($users as $user) {
                        $viewUrl = route('users.show', $user->id);
                        echo "<a href='".$viewUrl."'><li><i class='fa fa-user me-2'></i><span>" . $user->name . "</span></li></a>";
                    }
                    echo '</ul></li>';
                }
                /* Todo add other searchable objects */
                echo '</ul>';
            }

        }

    }
