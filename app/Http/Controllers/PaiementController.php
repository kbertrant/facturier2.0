<?php

namespace App\Http\Controllers;

use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Proformas;
use App\Services\DecodeService;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaiementController extends Controller
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

            $tasks = Paiement::select('paiements.id as id','ref_pay','date_pay','mttc_pay','stat_pay',
            'name_cli')
            ->join('clientes','clientes.id','=','paiements.id_cli')
            ->where('paiements.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('stat_pay', function ($row) {
                if($row->stat_fac == "Pending"){
                $span = "<span class='badge bg-label-danger'>".$row->stat_pay."</span>";
                }else{$span = "<span class='badge bg-label-success'>".$row->stat_pay."</span>";}
                return  $span;})
            ->addColumn('stat_pay','action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/payment/show/".$row->id."'><i data-lucide='plus' class='w-5 h-5'>Details</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/payment/edit/".$row->id."' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/payment/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $facs = Facture::where('factures.id_ent','=',Auth::user()->id_ent)
        ->join('clientes','clientes.id','=','factures.id_cli')
        ->select('ref_fac as ref','mttc_fac as mttc','name_cli')->get();
        //$profs = Proformas::where('proformas.id_ent','=',Auth::user()->id_ent)->union($facs)->get();
        $historic = new HistoricService();
        $historic->Add('List paiement');
        return view('payment.listPayment',['facs'=>$facs]);
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
            'num_fac' => ['required'],
            'mode_pay' => ['required'],
            'mttc_pay' => ['required']
        ]); 
        $decode = new DecodeService();

        $date = now();
        $result = $date->format('ymdHis');
        $fac = Facture::where('ref_fac','LIKE',$request->num_fac)->first();
        $historic = new HistoricService();
        $historic->Add('Add new payment');
        dd($fac);
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
        //
    } //
}
