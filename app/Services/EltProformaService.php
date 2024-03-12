<?php 

namespace App\Services;

use App\Models\ElementProforma;
use Illuminate\Support\Facades\Auth;

class EltProformaService
{
    public function CreateEltProforma($id_prod,$id_pro,$ep_qty,$ep_pu,$tva_apply){

        $ep = new ElementProforma();
        $ep->id_prod = $id_prod;
        $ep->id_pro = $id_pro;
        $ep->ep_qty = $ep_qty;
        $ep->ep_pu = $ep_pu;
        if($tva_apply=="on"){
            $ep->ep_tva = $ep_pu*$ep_qty*0.1925;  
            $ep->ep_mht = ($ep_pu*$ep_qty) - ($ep_pu*$ep_qty*0.1925);
        }else{
            $ep->ep_tva = 0;  
            $ep->ep_mht = $ep_pu*$ep_qty;
        }
        //dd($ep);
        $ep->ep_ttc = $ep_pu*$ep_qty;
        $ep->ep_stat = 'Pending';
        $ep->id_ent = Auth::user()->id_ent;
        $ep->save();

        return $ep;
    }

    public function ListEP($id_pro){
        return $ep = ElementProforma::where('id_pro','=',$id_pro)->get();
    }
}