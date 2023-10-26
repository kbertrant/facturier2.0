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
        'rs_cli',
        'raison_sociale',
        'cl_rccm',
        'cl_nui',
        'cl_email',
        'status',
        'id_ent',
        'id_tc' 
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }

    public function typeClient(){
        
        return $this->belongsTo(TypeCliente::class,'id_tc');
    }
    
    public function factures(){
        
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
