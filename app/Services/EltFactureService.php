<?php 

namespace App\Services;

use App\Models\ElementFacture;
use Illuminate\Support\Facades\Auth;

class EltFactureService
{
    public function CreateEltFacture($id_prod,$id_fac,$ef_qty,$ef_pu,$ep_mht,$tva_apply,$ef_lib){

        $ef = new ElementFacture();
        $ef->id_prod = $id_prod;
        $ef->id_fac = $id_fac;
        $ef->ef_qty = $ef_qty;
        $ef->ef_pu = $ef_pu;
        $ef->ef_lib = $ef_lib;
        if($tva_apply=="on"){
            $ef->ef_tva = $ef_pu*$ef_qty*0.1925;  
            $ef->ef_mht = $ep_mht;
        }else{
            $ef->ef_tva = 0;  
            $ef->ef_mht = $ep_mht;
        }
        $ef->ef_ttc = $ep_mht + $ef->ef_tva;
        $ef->ef_stat = 'Pending';
        $ef->id_ent = Auth::user()->id_ent;
        $ef->save();

        return $ef;
    }

    public function ListEF($id_fac){
        return $ef = ElementFacture::where('id_fac','=',$id_fac)->get();
    }
}