<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    
    protected $fillable = [
        
        'ref_pay',
        'date_pay',
        'amount_pay',
        'solde_pay',
        'mode_pay',
        'status',
        'id_cli',
        'id_exe',
        'id_fac',
        'id_ent' 
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }
    
    public function cliente(){
        
        return $this->belongsTo(Cliente::class,'id_cli');
        }

    public function year_exercice(){
        
        return $this->belongsTo(Year_exercice::class,'id_exe');
        }

    public function facture(){
        
        return $this->belongsTo(Facture::class,'id_fac');
        }


    

    public function remboursements(){
        
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
