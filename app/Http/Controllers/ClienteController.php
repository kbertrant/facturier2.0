<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\TypeCliente;
use App\Services\ClienteService;
use App\Services\DecodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Ui\Presets\Vue;

class ClienteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = Cliente::select('clientes.id','name_cli','phone_cli','address_cli','raison_sociale',
            'cl_rccm','cl_nui','cl_email','clientes.status','name_tc','clientes.id_ent')
            ->join('type_clientes','type_clientes.id','=','clientes.id_tc')
            ->where('clientes.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i class='bx bxs-receipt'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/cliente/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/cliente/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $list_tcs = TypeCliente::all();
       return view('client.listClient',['list_tcs'=>$list_tcs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        Validator::make($request->all(),[
            'name_cli' => ['required'],
            'phone_cli' => ['required'],
            'address_cli' => ['required'],
            'id_tc' => ['required'],
        ]); 
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id_tc);
        $cli = new ClienteService();
        $cli->CreateCliente($request->name_cli,$request->phone_cli,$request->address_cli,
        $request->raison_sociale,$request->cl_rccm,$request->cl_nui,$request->cl_email,$decoded_id);

        return redirect()->back()->with('success','Client ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cli = Cliente::find($id);
        $cli->delete();
        return redirect()->back()->with('success','client supprimé');
    }
    
}
