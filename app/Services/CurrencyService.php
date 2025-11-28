<?php 
namespace App\Services;

use App\Models\Cliente;
use App\Models\Currency;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CurrencyService
{


    public function MyUsrCurrency($id_cur){

        $cur = Currency::find($id_cur);
        return $cur->code;
    }

    public function ChangeMyCurrency($id_cur){
        
        $usr = User::find( Auth::user()->id);
        $usr->id_cur = $id_cur;
        $usr->save();

        $cur = Currency::find(Auth::user()->id_cur);
        return $cur->code;
    }
}