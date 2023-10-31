<?php

namespace App\Models;


use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
           'stat_fac',
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

    public function ElementFactures(){
        
        return $this->hasMany(ElementFacture::class);
    }

    public function paiements(){
        
        return $this->hasMany(Paiement::class);
       }

    public function remboursement(){
        
        return $this->hasMany(Remboursement::class);
       }

    /**
     * Hash the blog ids
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function id(): Attribute
    {
        return  Attribute::make(
            get: fn ($value) => Hashids::encode($value)
        );
    }
}
