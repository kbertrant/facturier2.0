<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    
    protected $fillable = [
 
           'date_fac',
           'ref_fac',
           'amount_fac',
           'qty_fac',
           'tva_price',
           'reduction',
           'status',
           'id_cli',
           'id_ent',
           'id_pro',
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }

    public function cliente(){
        
        return $this->belongsTo(Cliente::class,'id_cli');
        }

    public function produit(){
        
        return $this->belongsTo(Produit::class,'id_pro');
        }



    public function paiement(){
        
        return $this->hasMany(Paiement::class);
       }

    public function remboursement(){
        
        return $this->hasMany(Remboursement::class);
       }
}
