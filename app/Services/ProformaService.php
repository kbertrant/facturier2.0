<?php 

namespace App\Services;

use App\Models\ElementProforma;
use App\Models\Proformas;
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
        $pro->save();

        return $pro;
    }

    public function GetTVAValue($somme){
        return $tva = $somme * 0.1925;
    }

    public function GetReduction($somme,$reduction){
        return $red = ($somme * $reduction)/100;
    }
}