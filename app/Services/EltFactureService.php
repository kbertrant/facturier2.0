<?php 

namespace App\Services;

use App\Models\ElementFacture;
use Illuminate\Support\Facades\Auth;

class EltFactureService
{
    public function CreateEltFacture($id_prod,$id_fac,$ef_qty,$ef_pu,$ef_ttval){

        $ef = new ElementFacture();
        $ef->id_prod = $id_prod;
        $ef->id_fac = $id_fac;
        $ef->ef_qty = $ef_qty;
        $ef->ef_pu = $ef_pu;
        $ef->ef_ttval = $ef_ttval;
        $ef->ef_stat = 'Pending';
        $ef->id_ent = Auth::user()->id_ent;
        $ef->save();

        return $ef;
    }

    public function ListEF($id_fac){
        return $ef = ElementFacture::where('id_fac','=',$id_fac)->get();
    }
}