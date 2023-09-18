<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historic extends Model
{
    use HasFactory;


protected $fillable =[

    'lib_histo',
    'date_histo',
    'id_ent',
    'id_usr'  
    ];

    public function entreprise(){
        
        return $this->belongsTo(Entreprise::class,'id_ent');
        }
    public function user(){
        
        return $this->belongsTo(User::class,'id_usr');
        }    
}
