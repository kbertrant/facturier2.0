<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_produit extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'cat_name',
        'cat_stat',
        'id_ent' 
    ];

    public function entreprise(){
        return $this->belongsTo(Entreprise::class,'id_ent');
    }



    public function produits(){
        return $this->hasMany(Produit::class);
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
