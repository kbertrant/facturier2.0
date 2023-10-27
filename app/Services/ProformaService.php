<?php 

namespace App\Services;

use App\Models\ElementProforma;
use App\Models\Proformas;
use Illuminate\Support\Facades\Auth;

class ProformaService
{
    public function CreateProforma($id_cli,$pro_ref,$amount_pro,$qty_pro,$tva_price,$reduction){

        $pro = new Proformas();
        $pro->id_cli = $id_cli;
        $pro->date_pro = now();
        $pro->pro_ref = $pro_ref;
        $pro->amount_pro = $amount_pro;
        $pro->qty_pro = $qty_pro;
        $pro->tva_price = $tva_price;
        $pro->reduction = $reduction;
        $pro->status = 'A';
        $pro->stat_pro = 'Pending';
        $pro->id_ent = Auth::user()->id_ent;
        $pro->save();

        return $pro;
    }

    public function SetPriceProforma($id_pro,$amount,$qty,$tva,$reduct){

        $pro = Proformas::find($id_pro);
        $pro->amount_pro = $amount - $reduct;
        $pro->qty_pro = $qty;
        $pro->tva_price = $tva;
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