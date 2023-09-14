<?php

namespace App\Models;

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
       
       public function historic(){
        
        return $this->hasMany(Historic::class);
       } 
       
       public function livraison(){
        
        return $this->hasMany(Livraison::class);
       } 
       
       public function paiement(){
        
        return $this->hasMany(Paiement::class);
       } 
       
       public function produit(){
        
        return $this->hasMany(Produit::class);
       } 
       
       public function proformas(){
        
        return $this->hasMany(Proformas::class);
       }
       
       public function remboursement(){
        
        return $this->hasMany(Remboursement::class);
       }
       
       public function user(){
        
        return $this->hasMany(User::class);
       }  
       
       
}
