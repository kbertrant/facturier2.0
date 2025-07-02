<?php

namespace App\Http\Controllers;

use App\Models\Cat_produit;
use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\ElementProforma;
use App\Services\ClienteService;
use App\Services\DecodeService;
use App\Services\EltFactureService;
use App\Services\EltProformaService;
use App\Services\FactureService;
use App\Services\HistoricService;
use App\Services\ProformaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PrestationController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function formQuotation(Request $request)
    {
        
        $clients = Cliente::where('clientes.id_ent','=',Auth::user()->id_ent)->get();
        return view('prestation.quotation',['clients'=>$clients]);
    }

    public function formInvoice(Request $request)
    {
        $clients = Cliente::where('clientes.id_ent','=',Auth::user()->id_ent)->get();
        return view('prestation.invoice',['clients'=>$clients]);
    }

    public function saveQuotation(Request $request)
    {
        
        //dd($request);
        $validator = Validator::make($request->all(), [
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'your_price' => ['required'],
            'reduction' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try { 
            DB::beginTransaction();
            $decode = new DecodeService();
            $date = now();
            $result = $date->format('ymdHis');
            $cli = Cliente::where('name_cli', 'like', $request->id_cli)->first();
            
            if($cli == null){
                $cliservice = new ClienteService();
                $cli = $cliservice->CreateCliente($request->id_cli,'phone','Adresse',null,null,null,null,1);
                //dd($cli);
            }
            $dcod_cli_id = $decode->DecodeId($cli->id);
            //dd($cli);
            $prof = new ProformaService();
            $new_prof = $prof->CreateProforma($dcod_cli_id, $result, 0, 0, 0, 0, 0, $request->reduction);
            $dcode_pro_id = $decode->DecodeId($new_prof->id);
            $s = 0;
            //dd($new_prof);
            foreach ($request->id_prod as $pr) {
                //dd($pr);
                $i = $s++;
                $ep = new EltProformaService();
                $ep->CreateEltPrestation($dcode_pro_id,$request->quantity[$i], $request->your_price[$i], $request->quantity[$i]*$request->your_price[$i], $request->tva_apply,$pr);
                
            }

            $mht = ElementProforma::where('id_pro', '=', $dcode_pro_id)->sum('ep_mht');
            $all_qty = ElementProforma::where('id_pro', '=', $dcode_pro_id)->sum('ep_qty');
            //dd($all_qty);
            $red = $prof->GetReduction($mht, $request->reduction);
            $amountRed = $mht - $red; 
            
            //set value of deducted at source
            if($request->rs_apply=="on"){
                $rs = $prof->GetRSValue($amountRed,$request->tva_apply);
            }else{$rs = 0;}
            //amount ht IR deducted
            $amountIR = $amountRed - $rs;
            //set tva value
            if($request->tva_apply=="on"){$tva = $prof->GetTVAValue($amountIR);}else{$tva = 0;} 

            $up_pro = $prof->SetPriceProforma($dcode_pro_id,$mht, $tva, $all_qty, $red,$rs);

            $historic = new HistoricService();
            $historic->Add('Add new proforma');
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return redirect()->back()->with('success', 'Proforma de prestation ajoutée');
    }

    public function saveInvoice(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'your_price' => ['required'],
            'reduction' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try { 
            DB::beginTransaction();
            $decode = new DecodeService();
            $date = now();
            $result = $date->format('ymdHis');
            $cli = Cliente::where('name_cli', 'like', $request->id_cli)->first();
            
            if($cli == null){
                $cliservice = new ClienteService();
                $cli = $cliservice->CreateCliente($request->id_cli,'phone','Adresse',null,null,null,null,1);
                //dd($cli);
            }
            $dcod_cli_id = $decode->DecodeId($cli->id);
            //dd($cli);
            $fac = new FactureService();
            $new_fac = $fac->CreateFacture($dcod_cli_id,null,$result,0,0,0,0,0,$request->reduction);
            $dcode_fac_id = $decode->DecodeId($new_fac->id);
            $s = 0;
            //dd($new_prof);
            foreach ($request->id_prod as $pr) {
                //dd($pr);
                $i = $s++;
                $ef = new EltFactureService();
                $ef->CreateEltPrestation($dcode_fac_id,$request->quantity[$i], $request->your_price[$i], $request->quantity[$i]*$request->your_price[$i], $request->tva_apply,$pr);
                
            }

            $mht = ElementFacture::where('id_fac', '=', $dcode_fac_id)->sum('ef_mht');
            $all_qty = ElementFacture::where('id_fac', '=', $dcode_fac_id)->sum('ef_qty');
            //dd($all_qty);
            $red = $fac->GetReduction($mht, $request->reduction);
            $amountRed = $mht - $red; 
            
            //set value of deducted at source
            if($request->rs_apply=="on"){
                $rs = $fac->GetRSValue($amountRed,$request->tva_apply);
            }else{$rs = 0;}
            //amount ht IR deducted
            $amountIR = $amountRed - $rs;
            //set tva value
            if($request->tva_apply=="on"){$tva = $fac->GetTVAValue($amountIR);}else{$tva = 0;} 

            $up_fac = $fac->SetPriceFacture($dcode_fac_id,$amountIR,$mht,$tva,$all_qty,$red,$rs);

            $historic = new HistoricService();
            $historic->Add('Add new invoice');
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return redirect()->back()->with('success', 'Facture de prestation ajoutée');
    }
}