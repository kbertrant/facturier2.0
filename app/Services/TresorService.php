<?php 

namespace App\Services;

use App\Models\Tresorerie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class TresorService
{
    public function transac($amount,$sens){
        //get last row insert in table
        $tresor =  Tresorerie::latest('id')->first();
        //dd($tresor);
        $t = 0;
        if($tresor==null){$t = 0;}else{$t = $tresor->amount_tres;}
        $ep = new Tresorerie();
        if($sens=="IN"){
            $ep->amount = $amount;
            $ep->amount_tres = ($t+$amount);
            $ep->mouvement = $sens;
            $ep->date_tres = now();
            $ep->id_ent = Auth::user()->id_ent;
            $ep->save();
        }else if($sens=="OUT" || $tresor >= $amount){
            $ep->amount = $amount;
            $ep->amount_tres = ($t-$amount);
            $ep->mouvement = $sens;
            $ep->date_tres = now();
            $ep->id_ent = Auth::user()->id_ent;
            $ep->save();
        }else{
            throw ValidationException::withMessages(['tresorerie' => 'Vos fonds sont insuffisants']);
        }
        

        return $ep;
    }

    
}