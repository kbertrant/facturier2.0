<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remboursement extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'date_remb',
        'ref_remb',
        'amount_remb',
        'mode_remb',
        'status',
        'id_cli',
        'id_ent',
        'id_fac',
        'id_pay'        
    ];

    public function entreprise(){
        return $this->belongsTo(Entreprise::class,'id_ent');
    }

    public function cliente(){
        return $this->belongsTo(Cliente::class,'id_cli');
    }

    public function paiement(){
        return $this->belongsTo(Paiement::class,'id_pay');
    }

    public function facture(){
        return $this->belongsTo(Facture::class,'id_fac');
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
