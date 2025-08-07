<?php 

namespace App\Services;

use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ShopService
{
    public function Add($name_shop,$address_shop,$id_ent){

        $sh = new Shop();
        $sh->name_shop = $name_shop;
        $sh->address_shop = $address_shop;
        $sh->id_ent = $id_ent;
        $sh->save();

        return $sh;
    }
}