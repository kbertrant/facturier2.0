<?php 

namespace App\Services;

use App\Models\Produit;
use Illuminate\Support\Facades\Auth;

class ProduitService
{
    public function CreateProduit($code_prod,$name_prod,$desc_prod,$price_prod,$qty_prod,$color_prod,
    $size_prod,$type_content,$detail,$id_cat){

        //var_dump($account_num,$balance,$type_acc_id,$cus_id);
        $catpro = new Produit();
        $catpro->code_prod = $code_prod;
        $catpro->name_prod = $name_prod;
        $catpro->desc_prod = $desc_prod;
        $catpro->price_prod = $price_prod;
        $catpro->qty_prod = $qty_prod;
        $catpro->color_prod = $color_prod;
        $catpro->size_prod = $size_prod;
        $catpro->type_content = $type_content;
        $catpro->detail = $detail;
        $catpro->status = 'A';
        $catpro->id_cat = $id_cat;
        $catpro->id_ent = Auth::user()->id_ent;
        $catpro->save();

        return $catpro;

    }

    public function decrementQteProduct($qte,$id_prod){
        $product = Produit::find($id_prod);
        $product->qty_prod = ($product->qty_prod - $qte);
        $product->save();
    }

    public function getPriceProduct($id_prod){
        $prod = Produit::find($id_prod);
        return $prod->price_prod;
    }
}