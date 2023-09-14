<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;

    protected $fillable = [
        'four_name',
        'four_code',
        'four_adress',
        'four_phone',
        'four_stat',
        'resp_name',
        'id_ent'    
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }

    public function livraison(){
        
        return $this->hasMany(Livraison::class);
       }
    
}
