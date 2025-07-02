<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElementFacture extends Model
{
    use HasFactory;

    protected $fillable = [
        'ef_qty',
        'ef_pu',
        'ef_ttval',
        'ef_stat',
        'ef_lib',
        'id_fac',
        'id_pro',
        'id_prod',
        'id_ent' 
        
    ];

    public function Facture(){
        
        return $this->belongsTo(Facture::class,'id_fac');
    }

    public function Proforma(){
        
        return $this->belongsTo(Proformas::class,'id_pro');
    }


    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }
}
