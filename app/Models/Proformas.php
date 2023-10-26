<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proformas extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'date_pro',
        'pro_ref',
        'amount_pro',
        'qty_pro',
        'tva_price',
        'reduction',
        'status',
        'stat_pro',
        'id_cli',
        'id_ent'
        
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }

    public function cliente(){
        
        return $this->belongsTo(Cliente::class,'id_cli');
    }

    public function elementProformas(){
        
        return $this->hasMany(ElementProforma::class);
    }
}
