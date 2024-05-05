<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementProforma extends Model
{
    use HasFactory;

    protected $fillable = [
        'ep_qty',
        'ep_pu',
        'ep_ttc',
        'ep_mht',
        'ep_tva',
        'ep_lib',
        'ep_stat',
        'id_pro',
        'id_prod',
        'id_ent' 
        
    ];

    public function proforma(){
        
        return $this->belongsTo(Proformas::class,'id_pro');
    }

    public function produit(){
        
        return $this->belongsTo(Produit::class,'id_prod');
    }

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }
}
