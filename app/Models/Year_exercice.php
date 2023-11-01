<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year_exercice extends Model
{
    use HasFactory;


    protected $fillable = [
        'year',
        'status'
    ];

    
    public function depense(){
        
        return $this->hasMany(Depense::class);
    }

      
    public function paiement(){
        
        return $this->hasMany(Paiement::class);
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
