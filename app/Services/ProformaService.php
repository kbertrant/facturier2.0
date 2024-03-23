<?php 

namespace App\Services;

use App\Models\ElementProforma;
use App\Models\ElementFacture;
use App\Models\Proformas;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class ProformaService
{
    public function CreateProforma($id_cli,$pro_ref,$mttc_pro,$mht_pro,$tva_pro,$qty_pro,$reduction){

        $pro = new Proformas();
        $pro->id_cli = $id_cli;
        $pro->date_pro = now();
        $pro->pro_ref = $pro_ref;
        $pro->mttc_pro = $mttc_pro;
        $pro->mht_pro = $mht_pro;
        $pro->tva_pro = $tva_pro;
        $pro->qty_pro = $qty_pro;
        $pro->reduction = $reduction;
        $pro->status = 'A';
        $pro->stat_pro = 'Pending';
        $pro->id_ent = Auth::user()->id_ent;
        $pro->id_usr = Auth::user()->id;
        $pro->save();

        return $pro;
    }

    public function SetPriceProforma($id_pro,$mttc,$mht,$tva,$qty,$reduct){

        $pro = Proformas::find($id_pro);
        $pro->mttc_pro = $mttc;
        $pro->qty_pro = $qty;
        $pro->mht_pro = $mht;
        $pro->tva_pro = $tva;
        $pro->reduction = $reduct;

        //dd($pro);
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
        $fac = $facSvc->CreateFacture($pro->id_cli,$idpro,$result,$pro->mttc_pro,$pro->mht_pro,$pro->tva_pro,$pro->qty_pro,$pro->reduction);
        //decode receive is form http
        
        $dcd_fac_id = $decode->DecodeId($fac->id);
        //set elements facturation
        //dd($fac);
        foreach ($eps as $ep) {
            
            $ef = new ElementFacture();
            $ef->id_prod =$ep->id_prod;
            $ef->id_fac = $dcd_fac_id;
            $ef->ef_qty = $ep->ep_qty;
            $ef->ef_pu = $ep->ep_pu;
            $ef->ef_tva = $ep->ep_tva; 
            $ef->ef_mht = $ep->ep_mht;
            $ef->ef_ttc = $ep->ep_ttc;
            $ef->ef_stat = 'Pending';
            $ef->id_ent = $ep->id_ent;
            $ef->save();
        }
    }
}