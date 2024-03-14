<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\PrivilegeRole;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $views = 'roles';

    protected $model = Role::class;

    protected $table = 'roles';

    public function index()
    {
        if(\request()->ajax()){
            $data = Role::latest()->get();
            return DataTables::of($data)
                             ->addIndexColumn()
                             ->addColumn('action', function($row){
                                 $viewUrl = route('roles.show', $row->id);
                                 $editUrl = route('roles.edit', $row->id);
                                 $deleteUrl = route('roles.destroy', $row->id);
                                 $actionBtn =   '<a href="'.$viewUrl.'" class="view btn btn-success btn-sm"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="'.$editUrl.'" class="edit btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a data-bs-toggle="modal" data-id="'.$row->id.'" data-link="'.$deleteUrl.'" data-bs-target="#deleteModal" title="Delete Role" href="#" class="item-delete btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                                 return $actionBtn;
                             })
                             ->rawColumns(['action'])
                             ->make(true);
        }
        return view('roles.index');
    }

    public function store(Request $request) {
        $this->authorize('create', $this->model);

        $data = array(
            'name' => request()->name,
        );
        $insert_id = Role::create($data);
        if (empty($insert_id)) {
            return redirect()->route('roles.index')->with('error','Resource not saved, Something went wrong.');
        }

        $privileges = request()->privileges;
        if($privileges){
            foreach($privileges as $privilege){
                $data_privilege = array(
                    'role_id' => $insert_id->id,
                    'privilege_id' => $privilege
                );
                PrivilegeRole::create($data_privilege);
            }
        }
        return redirect()->route('roles.show',['role' => $insert_id])->with('success', 'Resource saved successfully.');
    }

    public function destroy($id) {
        $data = $this->model::find($id);

        $this->authorize('delete', $data);

        if (empty($data)) {
            return back()->with('error', 'Resource not found.');
        }

        //Check usage
        if ($data->users instanceof Collection && $data->users->isEmpty()) {
            // Collection is empty
            $this->transact(function () use ($data) {
                return $data->delete();
            });

            return redirect(route("{$this->route_name}.index"))->with('success', 'Resource deleted successfully.');
        } else {
            // Collection is not empty
            return redirect(route("{$this->route_name}.index"))->with('error', 'Resource in use.');
        }
    }
}
