<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
 
    
    protected $fillable = [
      
        'lf_num',
        'lf_date',
        'lf_qte',
        'lf_stat',
        'id_four',
        'id_prod',
        'id_ent'
        
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }
    
    public function fournisseur(){
        
        return $this->belongsTo(Fournisseur::class,'id_four');
        }

    public function produit(){
        
        return $this->belongsTo(Entreprise::class,'id_prod');
        }

    
}
