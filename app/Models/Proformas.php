<?php

namespace App\Models;


use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proformas extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'date_pro',
        'pro_ref',
        'mttc_pro',
        'mht_pro',
        'tva_pro',
        'qty_pro',
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
