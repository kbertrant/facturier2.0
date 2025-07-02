<?php 

namespace App\Services;

use App\Models\Historic;
use Illuminate\Support\Facades\Auth;

class HistoricService
{
    public function Add($libelle){
        $hist = new Historic();
        $hist->lib_histo = $libelle;
        $hist->date_histo = now();
        $hist->id_usr = Auth::user()->id;
        $hist->id_ent = Auth::user()->id_ent;
        $hist->save();
        return $hist;
    }

    public function HistoricsUser($idusr){
        $tasks = Historic::select('historics.id','lib_histo','date_histo',
            'name')
            ->join('users','users.id','=','historics.id_usr')
            ->where('historics.id_usr','=',$idusr)->take(5)->orderBy('date_histo', 'desc')->get();
        return $tasks;
    }

    public function HistoricsEnt($ident){
        $tasks = Historic::select('historics.id','lib_histo','date_histo',
            'name')
            ->join('users','users.id','=','historics.id_usr')
            ->join('entreprises','entreprises.id','=','historics.id_ent')
            ->where('historics.id_ent','=',$ident)->take(5)->orderBy('date_histo', 'desc')->get();
        return $tasks;
    }
}