<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'ref_dep',
        'date_dep',
        'amount_dep',
        'solde_dep',
        'mode_dep',
        'status',
        'id_exe',
        'id_ent' 
        
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }
    
    public function year_exercice(){
        
        return $this->belongsTo(Year_exercice::class,'id_exe');
    }
    
    
}
