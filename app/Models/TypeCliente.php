<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeCliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_tc',
        'status',
        'id_ent'
        
    ];

    public function clientes(){
        
        return $this->hasMany(Cliente::class);
    }
}
