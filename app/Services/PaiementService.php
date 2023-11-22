<?php 

namespace App\Services;

use App\Models\Paiement;
use Illuminate\Support\Facades\Auth;

class PaiementService
{
    public function Paid($ref_pay,$fac_id, $mht_fac,$amount,$mode_pay,$solde,$stat,$cli_id){
        $pay = new Paiement();
        $pay->ref_pay = $ref_pay;
        $pay->date_pay = now();
        $pay->mttc_pay = $amount;
        $pay->mht_pay = $amount;
        $pay->mode_pay = $mode_pay;
        $pay->stat_pay = $stat;
        $pay->solde_pay = $solde;
        $pay->id_fac = $fac_id;
        $pay->id_cli = $cli_id;
        $pay->id_ent = Auth::user()->id_ent;
        return $pay;
    }
}