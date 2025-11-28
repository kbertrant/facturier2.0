<?php

namespace App\Models;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable,HasRoles;

    protected $table = "users";
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'stat',
        'ville',
        'role',
        'id_ent',
        'id_shop',
        'image',
        'regim_fiscal_ent',
        'exp_date',
        'id_cur'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
    }

    public function shop(){
        
        return $this->belongsTo(Shop::class,'id_shop');
    }

    public function historic(){
        
        return $this->hasMany(Historic::class);
    }

    /**
     * Hash the blog ids
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
