<?php 

namespace App\Services;

use App\Models\Fournisseur;
use Illuminate\Support\Facades\Auth;

class FournisseurService
{
    public function CreateFournisseur($four_name,$four_code,$resp_name,
    $four_rccm,$four_nui,$four_phone,$four_email,
    $four_adress){

        $four = new Fournisseur();
        $four->four_name = $four_name;
        $four->four_code = $four_code;
        $four->four_adress = $four_adress;
        $four->four_phone = $four_phone;
        $four->resp_name = $resp_name;
        $four->four_stat = 'A';
        $four->four_rccm = $four_rccm;
        $four->four_nui = $four_nui;
        $four->four_email = $four_email;
        $four->id_ent = Auth::user()->id_ent;
        $four->save();

        return $four;
    }
}