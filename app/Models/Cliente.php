<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'name_cli',
        'phone_cli',
        'address_cli',
        'status',
        'id_ent' 
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }
    
    public function facture(){
        
         return $this->hasMany(Facture::class);
       }




    public function paiement(){
        
        return $this->hasMany(Paiement::class);
       }

    public function proformas(){
        
        return $this->hasMany(Proformas::class);
       }

    public function remboursement(){
        
        return $this->hasMany(Remboursement::class);
       }   
}
