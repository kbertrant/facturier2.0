<?php 

namespace App\Services;

use App\Models\ElementProforma;
use App\Models\ElementFacture;
use App\Models\Proformas;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class ProformaService
{
    public function CreateProforma($id_cli,$pro_ref,$mttc_pro,$mht_pro,$tva_pro,$rs_pro,$qty_pro,$reduction){

        $pro = new Proformas();
        $pro->id_cli = $id_cli;
        $pro->date_pro = now();
        $pro->pro_ref = $pro_ref;
        $pro->mttc_pro = $mttc_pro;
        $pro->mht_pro = $mht_pro;
        $pro->tva_pro = $tva_pro;
        $pro->rs_pro = $rs_pro;
        $pro->qty_pro = $qty_pro;
        $pro->reduction = $reduction;
        $pro->status = 'A';
        $pro->stat_pro = 'Pending';
        $pro->id_ent = Auth::user()->id_ent;
        $pro->id_usr = Auth::user()->id;
        $pro->save();

        return $pro;
    }

    public function SetPriceProforma($id_pro,$amountRed,$tva,$qty,$reduct,$rs){

        $pro = Proformas::find($id_pro);
        $pro->mttc_pro = ($amountRed + $tva - $rs);
        $pro->qty_pro = $qty;
        $pro->mht_pro = $amountRed;
        $pro->tva_pro = $tva;
        $pro->rs_pro = $rs;
        $pro->reduction = $reduct;
        $pro->save();

        return $pro;
    }

    public function GetTVAValue($somme){
        return $tva = $somme * 0.1925;
    }

    public function GetReduction($somme,$reduction){
        return $red = ($somme * $reduction)/100;
    }

    public function ValidateProforma($idpro){

        $decode = new DecodeService();
        $pro = Proformas::find($idpro);
        $dcd_pro_id = $decode->DecodeId($pro->id);
        $eps = ElementProforma::where('id_pro',$idpro)->get();
        //dd($eps);
        //change proforma status
        $pro->stat_pro = "VALIDATED";
        $pro->save();
        //add facture to pending 
        $date = now();
        $result = $date->format('YmdHis');
        $facSvc = new FactureService();
        $fac = $facSvc->CreateFacture($pro->id_cli,$idpro,$result,$pro->mttc_pro,$pro->mht_pro,$pro->tva_pro,$pro->rs_pro,$pro->qty_pro,$pro->reduction,$pro->rs_pro);
        //decode receive is form http
        
        $dcd_fac_id = $decode->DecodeId($fac->id);
        //set elements facturation
        //dd($eps);
        foreach ($eps as $ep) {
            
            $ef = new ElementFacture();
            if($ep->id_prod != null)
            {$ef->id_prod =$ep->id_prod;}
            $ef->id_fac = $dcd_fac_id;
            $ef->ef_qty = $ep->ep_qty;
            $ef->ef_pu = $ep->ep_pu;
            $ef->ef_tva = $ep->ep_tva; 
            $ef->ef_mht = $ep->ep_mht;
            $ef->ef_ttc = $ep->ep_ttc;
            $ef->ef_stat = 'Pending';
            $ef->id_ent = $ep->id_ent;
            $ef->ef_lib = $ep->ep_lib;
            $ef->save();
        }
    }

    public function GetRSValue($somme,$tva){
        if($tva=="on"){
            $rs = $somme * 0.022;
        }else{$rs = $somme * 0.055;}
        return $rs;
    }
}