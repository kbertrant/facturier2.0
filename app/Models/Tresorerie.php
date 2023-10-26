<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tresorerie extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'id_ent'
    ];

    public function entreprise(){
        return $this->belongsTo(Entreprise::class,'id_ent');
    }
}
