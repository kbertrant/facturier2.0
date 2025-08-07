<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_shop',
        'address_shop',
        'id_ent' 
    ];

    public function entreprise(){
        return $this->belongsTo(Entreprise::class,'id_ent');
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
