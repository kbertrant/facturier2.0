<?php 

namespace App\Services;

use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class PaiementService
{
    public function Paid($ref_pay,$fac_id,$amount,$mode_pay,$solde_pay,$cli_id){
        $pay = new Paiement();
        $pay->ref_pay = $ref_pay;
        $pay->date_pay = now();
        $pay->mttc_pay = $amount;
        $pay->mht_pay = $amount-($amount * 0.1925);
        $pay->tva_pay = $amount * 0.1925;
        $pay->mode_pay = $mode_pay;
        $pay->solde_pay = $solde_pay;
        $pay->id_fac = $fac_id;
        $pay->id_cli = $cli_id;
        $pay->stat_pay = "Paid";
        $pay->status = "A";
        $pay->id_ent = Auth::user()->id_ent;
        $pay->id_usr = Auth::user()->id;
        $pay->save();
        return $pay;
    }
}