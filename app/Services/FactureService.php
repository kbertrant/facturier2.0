<?php 

namespace App\Services;

use App\Models\ElementFacture;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class FactureService
{
    public function CreateFacture($id_cli,$id_pro,$ref_fac,$amount_fac,$qty_fac,$tva_price,$reduction){

        $fac = new Facture();
        $fac->id_cli = $id_cli;
        $fac->id_pro = $id_pro;
        $fac->date_fac = now();
        $fac->ref_fac = $ref_fac;
        $fac->amount_fac = $amount_fac;
        $fac->qty_fac = $qty_fac;
        $fac->tva_price = $tva_price;
        $fac->reduction = $reduction;
        $fac->status = 'A';
        $fac->stat_fac = 'Pending';
        $fac->id_ent = Auth::user()->id_ent;
        $fac->save();

        return $fac;
    }

    public function SetPriceFacture($id_fac,$amount,$qty,$tva,$reduct){

        $fac = Facture::find($id_fac);
        $fac->amount_fac = $amount - $reduct;
        $fac->qty_fac = $qty;
        $fac->tva_price = $tva;
        $fac->reduction = $reduct;
        $fac->save();

        return $fac;
    }

    public function GetTVAValue($somme){
        return $tva = $somme * 0.1925;
    }

    public function GetReduction($somme,$reduction){
        return $red = ($somme * $reduction)/100;
    }
}