<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Vinkla\Hashids\Facades\Hashids;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tresorerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'amount_tres',
        'date_tres',
        'mouvement',
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
