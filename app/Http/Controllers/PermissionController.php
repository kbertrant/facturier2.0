<?php

namespace App\Http\Controllers;

use App\Services\HistoricService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
         //$this->middleware('permission:permission-read|permission-create|permission-edit|permission-delete', ['only' => ['index','store']]);
         //$this->middleware('permission:permission-create', ['only' => ['create','store']]);
         //$this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
         //$this->middleware('permission:permission-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        if(request()->ajax()) {
            $tasks = Permission::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-1 viewdetails' data-id='".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-1' href='/perm/edit/".$row->id."'><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-1' href='/cat/produit/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $historic = new HistoricService();
        $historic->Add('List permissions');
        

        return view('permission.listPerm');
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);
    
        Permission::create(['name' => $request->input('name')]);
        return redirect()->back()->with('success','Permission ajoutée');
    }

    public function show(Permission $permission)
    {
        return view('permissions.show', compact('permission'));
    }

    public function edit(Permission $permission)
    {
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
    
        $permission->name = $request->input('name');
        $permission->save();
        return redirect()->route('permissions.index')->with('message', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('message', 'Permission deleted successfully');
    }
}
