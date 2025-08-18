<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleFormRequest;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('permission:role.read|role.create|role.edit|role.delete', ['only' => ['index','store']]);
        //$this->middleware('permission:role.create', ['only' => ['create','store']]);
        //$this->middleware('permission:role.edit', ['only' => ['edit','update']]);
        //$this->middleware('permission:role.delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if(request()->ajax()) {
            $tasks = Role::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-1 viewdetails' data-id='".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-1' href='/role/edit/".$row->id."'><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-1' href='/roles/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $historic = new HistoricService();
        $historic->Add('List roles');
        $permissions = Permission::all();

        return view('role.listRole',compact('permissions'));
    }

    public function create()
    {
        $permissions = Permission::get();
        return view('roles.create',compact('permissions'));
    }

    public function store(RoleFormRequest $request)
    {
        $data = $request->validated();
        try {

            $role = Role::create(['name' => $data['name']]);
            $role->syncPermissions($request['permission']);
            return redirect()->back()->with('success','Categorie ajoutée');

        } catch(\Exception $ex){

            return redirect('roles')->with('message','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function show(Role $role)
    {
        $role = Role::find($role->id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
                                ->where("role_has_permissions.role_id",$role->id)
                                ->get();
        return view('roles.show', compact('role','rolePermissions'));
    }

    public function edit( $id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$role->id)
                                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                                ->all();

        return view('role.editRole',compact('role','permission','rolePermissions'));
    }

    public function update(RoleFormRequest $request)
    {
        $data = $request->validated();
        dd($data);
        try {

            $role = Role::find($id);
            $role->name = $data['name'];
            $role->save();
            //dd($role);
            $role->syncPermissions($request->permission);
            //dd($role);
            return redirect()->route('role.list')->with('success','Role updated successfully');

        } catch(\Exception $ex){

            return redirect('my/role/list')->with('success','Something Went Wrong - '.$ex->getMessage());
        }
    }

    public function destroy(Role $role)
    {
        try {

            $role->delete();
            return redirect()->route('roles.index')->with('success','Role deleted successfully');
        } catch(\Exception $ex){

            return redirect('roles')->with('message','Something Went Wrong - '.$ex->getMessage());
        }
    }
}
