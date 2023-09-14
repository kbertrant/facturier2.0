<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'code_prod',
        'name_prod',
        'desc_prod',
        'price_prod',
        'qty_prod',
        'color_prod',
        'size_prod',
        'status',
        'id_cat',
        'id_ent'

    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }

    public function cat_produit(){
        
        return $this->belongsTo(Cat_produit::class,'id_cat');
        }

        
    
    public function facture(){
        
         return $this->hasMany(Facture::class);
       }

    public function livraison(){
        
        return $this->hasMany(Livraison::class);
       }
}
