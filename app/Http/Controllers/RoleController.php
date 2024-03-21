<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\PrivilegeRole;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
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
                                 $actionBtn =   '<a href="'.$viewUrl.'" class="view btn btn-success btn-sm btn-table"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                <a href="'.$editUrl.'" class="edit btn btn-primary btn-sm btn-table"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a data-bs-toggle="modal" data-id="'.$row->id.'" data-link="'.$deleteUrl.'" data-bs-target="#deleteModal" title="Delete Role" href="#" class="item-delete btn btn-danger btn-sm btn-table"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
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

    public function update($id) {
        $keys = array_keys(request()->all());
        $data = $this->model::findOrFail($id);

        $newRoles = [];
        foreach ($keys as $key) {
            if (method_exists($data, $key) && is_callable([$data, $key])) {
                $newRoles = array_merge($newRoles, request($key));
            }
        }

        // Retrieve all roles related to the role ID
        $oldRoles = DB::table('privilege_role')->where('role_id', $id)->pluck('privilege_id')->toArray();
        $oldRoles = array_map('intval', $oldRoles);

        // Determine removed roles
        $removedRoles = array_diff($oldRoles, $newRoles);

        // Determine added roles
        $addedRoles = array_diff($newRoles, $oldRoles);

        // Fetch names of removed roles
        $oldRolesArray = DB::table('privileges')->whereIn('id', $removedRoles)->pluck('name')->toArray();

        // Fetch names of added roles
        $newRolesArray = DB::table('privileges')->whereIn('id', $addedRoles)->pluck('name')->toArray();

        // Record log if there are changes
        if (!empty($oldRolesArray) || !empty($newRolesArray)) {
            AuditController::recordLog($data, 'privileges updated', implode(', ', $oldRolesArray), implode(', ', $newRolesArray));
        }

        parent::update($id);
        return redirect()->route('roles.show',['role' => $id])->with('success', 'Resource saved successfully.');
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
