<?php 

namespace App\Services;

use App\Models\Depense;
use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;

class DepenseService
{
    public function CreateDepense($ref_dep,$amount_dep,$label_dep,$solde_dep,
    $mode_dep,$decoded_id){

        $dep = new Depense();
        $dep->ref_dep = $ref_dep;
        $dep->amount_dep = $amount_dep;
        $dep->label_dep = $label_dep;
        $dep->solde_dep = $solde_dep;
        $dep->mode_dep = $mode_dep;
        $dep->date_dep = now();
        $dep->id_four = $decoded_id;
        $dep->status = 'Paid';
        $dep->id_ent = Auth::user()->id_ent;
        $dep->id_usr = Auth::user()->id;
        $dep->save();

        return $dep;

    }

}