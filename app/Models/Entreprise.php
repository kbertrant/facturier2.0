<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ent',
        'rc_ent',
        'nc_ent',
        'phone_ent',
        'address_ent',
        'owner_ent',
        'bank_ent',
        'logo_ent',
    ];
}
