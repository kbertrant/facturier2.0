<?php 

namespace App\Services;

use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class PaiementService
{
    public function Paid($ref_pay,$fac_id,$mttc,$mht,$mtva,$mode_pay,$solde_pay,$cli_id){
        $pay = new Paiement();
        $pay->ref_pay = $ref_pay;
        $pay->date_pay = now();
        $pay->mttc_pay = $mttc;
        $pay->mht_pay = $mht;
        $pay->tva_pay = $mtva;
        $pay->mode_pay = $mode_pay;
        $pay->solde_pay = $solde_pay;
        $pay->id_fac = $fac_id;
        $pay->id_cli = $cli_id;
        $pay->stat_pay = "Paid";
        $pay->status = "A";
        $pay->id_ent = Auth::user()->id_ent;
        $pay->id_shop = Auth::user()->id_shop;
        $pay->id_usr = Auth::user()->id;
        $pay->id_cur = Auth::user()->id_cur;
        $pay->save();
        return $pay;
    }
}