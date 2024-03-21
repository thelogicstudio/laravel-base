<?php

    namespace App\Http\Controllers;

    use App\Models\Role;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use Illuminate\Foundation\Bus\DispatchesJobs;
    use Illuminate\Foundation\Validation\ValidatesRequests;
    use Illuminate\Support\Facades\Event;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;
    use OwenIt\Auditing\Events\AuditCustom;
    use Yajra\DataTables\Facades\DataTables;

    class UserController extends BaseController {
        use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

        protected $views = 'users';

        protected $table = 'users';

        protected $model = User::class;

        public function index() {
            if(\request()->ajax()){
                $data = User::latest()->get();
                return DataTables::of($data)
                                 ->addIndexColumn()
                                 ->addColumn('type', function($row){
                                     $rolesArray = json_decode($row->roles, true);
                                     return array_column($rolesArray, 'name');
                                })
                                 ->addColumn('created_at', function($row){
                                     return date('Y-m-d', strtotime($row->created_at));
                                 })
                                 ->addColumn('action', function($row){
                                     $viewUrl = route('users.show', $row->id);
                                     $editUrl = route('users.edit', $row->id);
                                     $deleteUrl = route('users.destroy', $row->id);
                                     $actionBtn =   '<a href="'.$viewUrl.'" class="view btn btn-success btn-smmx-1"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <a href="'.$editUrl.'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>';
                                     if($row->id != auth()->id()) {
                                         $actionBtn .= '<a data-bs-toggle="modal" data-id="' . $row->id . '" data-link="' . $deleteUrl . '" data-bs-target="#deleteModal" title="Delete Role" href="#" class="item-delete btn btn-danger btn-sm mx-1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                                     }
                                     return $actionBtn;
                                 })
                                 ->rawColumns(['action'])
                                 ->make(true);
            }
            return view('users.index');
        }

        public function create($type_id = '', $entity = '') {
            $this->authorize('create', $this->model);
            return view("{$this->views}.create");
        }

        public function passwordFields(){
            $html = view("{$this->views}.password")->render();
            return response()->json($html);
        }

        public function store(Request $request) {
            $this->authorize('create', $this->model);
            $input = request()->all();
            if(request()->email != '') {
                $user_exists = User::where('email', request()->email)->first();
                if ($user_exists) {
                    return redirect()->route('users.index')->with('error', request()->email . ' already exists in the database.');
                }
            }
            $user_data = array(
                'name' => request()->name,
                'email' => request()->email,
                'password' => Hash::make(substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 10)),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            );

            $data = User::createNewUser($user_data);

            $insert_id = $data->id;
            if (empty($insert_id)) {
                return redirect()->route('users.index')->with('error','Resource not saved, Something went wrong.');
            }else{
                $data->roles()->attach(request()->type_id);
                return redirect()->route('users.show',['user' => $insert_id])->with('success', 'Resource saved successfully.');
            }

        }

        public function edit($id) {
            $data = $this->model::find($id);

            $this->authorize('update', $data);

            if (empty($data)) {
                return redirect(route("{$this->route_name}.index"))->with('error', 'Resource not found');
            }

            return view("{$this->views}.edit")->with('user',$data)->with(Str::singular($this->views), $data);
        }

        public function update($id){
            parent::update($id);
            $data = User::find($id);
            $rolesArray = json_decode($data->roles, true);
            $roles_name = array_column($rolesArray, 'name');
            $roles_id = array_column($rolesArray, 'id');
            $data->roles()->detach();
            $data->roles()->attach(request()->type_id);
            //Audit
            if(request()->type_id != $roles_id[0]) {
                $new_value = Role::find(request()->type_id)->name;
                AuditController::recordLog($data, 'changed role', $roles_name[0], $new_value);
            }
            //End Audit
            return view("{$this->views}.show")->with('user',$data)->with(Str::singular($this->views), $data);
        }

        public function getContactById(Request $request){
            $id = $request->id;
            $data = $this->model::find($id);
            return response()->json($data);
        }
    }
