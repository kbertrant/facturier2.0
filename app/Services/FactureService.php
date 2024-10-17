<?php 

namespace App\Services;

use App\Models\ElementFacture;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class FactureService
{
    public function CreateFacture($id_cli,$id_pro,$ref_fac,$mttc_fac,$mht_fac,$tva_fac,$rs_fac,$qty_fac,$reduction){

        $fac = new Facture();
        $fac->id_cli = $id_cli;
        $fac->id_pro = $id_pro;
        $fac->date_fac = now();
        $fac->ref_fac = $ref_fac;
        $fac->mttc_fac = $mttc_fac;
        $fac->mht_fac = $mht_fac;
        $fac->tva_fac = $tva_fac;
        $fac->rs_fac = $rs_fac;
        $fac->qty_fac = $qty_fac;
        $fac->reduction = $reduction;
        $fac->status = 'A';
        $fac->stat_fac = 'Pending';
        $fac->id_ent = Auth::user()->id_ent;
        $fac->id_usr = Auth::user()->id;
        $fac->save();

        return $fac;
    }

    public function SetPriceFacture($id_fac,$amountRed,$mht,$tva,$qty,$reduct,$rs){
        //dd($id_fac);
        $fac = Facture::find($id_fac);
        $fac->mttc_fac = ($amountRed+$tva-$rs);
        $fac->mht_fac = $mht;
        $fac->qty_fac = $qty;
        $fac->tva_fac = $tva;
        $fac->reduction = $reduct;
        $fac->rs_fac = $rs;
        $fac->save();
        
        return $fac;
    }

    public function GetTVAValue($somme){
        return $tva = $somme * 0.1925;
    }

    public function GetRSValue($somme,$tva){
        if($tva=="on"){
            $rs = $somme * 0.022;
        }else{$rs = $somme * 0.055;}
        return $rs;
    }

    public function GetReduction($somme,$reduction){
        return $red = ($somme * $reduction)/100;
    }
}