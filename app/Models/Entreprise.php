<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ent',
        'rc_ent',
        'nc_ent',
        'phone_ent',
        'address_ent',
        'owner_ent',
        'bank_ent',
        'logo_ent',
    ];

    public function cat_produit(){
        
        return $this->hasMany(Cat_produit::class);
    }
    
    public function cliente(){
        
        return $this->hasMany(Cliente::class);
    }    
    
    public function depense(){
        
         return $this->hasMany(Depense::class);
    }    

    public function facture(){
        
        return $this->hasMany(Facture::class);
    }
       
    public function fournisseur(){
        
        return $this->hasMany(Fournisseur::class);
    }
       
    public function historics(){
        
        return $this->hasMany(Historic::class);
    } 
       
    public function livraisons(){
        
        return $this->hasMany(Livraison::class);
    } 
       
    public function paiements(){
        
        return $this->hasMany(Paiement::class);
    } 
       
    public function produits(){
        
        return $this->hasMany(Produit::class);
    } 
       
    public function proformas(){
        
        return $this->hasMany(Proformas::class);
    }
       
    public function remboursements(){
        
        return $this->hasMany(Remboursement::class);
    }
       
    public function user(){
        return $this->hasMany(User::class);
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
