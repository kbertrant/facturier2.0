<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\Proformas;
use App\Models\TypeCliente;
use App\Services\ClienteService;
use App\Services\DecodeService;
use App\Services\HistoricService;
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
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/cliente/show/".$row->id."'><i class='bx bxs-receipt'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/cliente/edit/".$row->id."'><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/cliente/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $list_tcs = TypeCliente::all();

        $historic = new HistoricService();
        $historic->Add('List client');
        
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
        $validator =Validator::make($request->all(),[
            'name_cli' => ['required','unique:clientes'],
            'phone_cli' => ['required'],
            'address_cli' => ['required'],
            'id_tc' => ['required'],
        ]); 
        
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id_tc);
        $cli = new ClienteService();
        $cli->CreateCliente($request->name_cli,$request->phone_cli,$request->address_cli,
        $request->raison_sociale,$request->cl_rccm,$request->cl_nui,$request->cl_email,$decoded_id);

        $historic = new HistoricService();
        $historic->Add('Add new client');

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
        
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $count = Facture::where('id_cli','=',$decoded_id)->count();
        $sum_pay = Facture::where('id_cli','=',$decoded_id)->where('stat_fac','=','PAID')->sum('mttc_fac');
        $sum_to_pay = Facture::where('id_cli','=',$decoded_id)->where('stat_fac','=','PENDING')->sum('mttc_fac');
        $fac = Facture::where('id_cli','=',$decoded_id)->get();
        $ent = Entreprise::find(Auth::user()->id_ent);
        $cl = Cliente::find($decoded_id);

        //dd($count);
        return view('client.detailClient',['fac'=>$fac,'cl'=>$cl,'ent'=>$ent,
        'id_cli'=>$decoded_id, 'count'=>$count, 'sum_pay'=>$sum_pay,'sum_to_pay'=>$sum_to_pay]);
   
    }

    public function edit($id)
    {
        //dd($id);
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $cl = Cliente::find($decoded_id);
        //dd($cl);
        $list_tcs = TypeCliente::all();
        return view('client.editClient',['cl'=>$cl,'list_tcs'=>$list_tcs]);
   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name_cli' => ['required'],
            'phone_cli' => ['required'],
            'address_cli' => ['required'],
            'id_tc' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id);
        $idtc = $decode->DecodeId($request->id_tc);

        $cl = Cliente::find($decoded_id);
        $cl->name_cli = $request->name_cli;
        $cl->phone_cli = $request->phone_cli;
        $cl->address_cli = $request->address_cli;
        $cl->rs_cli = $request->rs_cli;
        $cl->raison_sociale= $request->raison_sociale;
        $cl->cl_rccm = $request->cl_rccm;
        $cl->cl_nui = $request->cl_nui;
        $cl->cl_email = $request->cl_email;
        //$cl->status= $request->status;
        $cl->id_tc = $idtc;
        $cl->save();

        $historic = new HistoricService();
        $historic->Add('update a client');

        return redirect()->route('cliente.main')->with('success','Client modifié avec succes');

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
