<?php 

namespace App\Services;

use App\Models\ElementProforma;
use Illuminate\Support\Facades\Auth;

class EltProformaService
{
    public function CreateEltProforma($id_prod,$id_pro,$ep_qty,$ep_pu,$ep_mht,$tva_apply,$ep_lib){

        //dd($id_prod,$id_pro,$ep_qty,$ep_pu,$ep_mht,$tva_apply,$ep_lib);
        $ep = new ElementProforma();
        $ep->id_prod = $id_prod;
        $ep->id_pro = $id_pro;
        $ep->ep_qty = $ep_qty;
        $ep->ep_pu = $ep_pu;
        $ep->$ep_lib = $ep_lib;
        if($tva_apply=="on"){
            $ep->ep_tva = $ep_pu*$ep_qty*0.1925;  
            $ep->ep_mht = $ep_mht;
        }else{
            $ep->ep_tva = 0;  
            $ep->ep_mht = $ep_mht;
        }
        
        $ep->ep_ttc = $ep_mht + $ep->ep_tva;
        $ep->ep_stat = 'Pending';
        $ep->id_ent = Auth::user()->id_ent;
        $ep->save();

        return $ep;
    }

    public function ListEP($id_pro){
        return $ep = ElementProforma::where('id_pro','=',$id_pro)->get();
    }
}