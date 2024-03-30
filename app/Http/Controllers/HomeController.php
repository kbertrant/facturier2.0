<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\Paiement;
use App\Models\Produit;
use App\Services\HistoricService;
use Faker\Provider\ar_EG\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    { 
        $user = Auth::user();
        $products = Produit::where('produits.id_ent', '=', Auth::user()->id_ent)->count();
        $paiements = Paiement::where('paiements.id_ent','=',Auth::user()->id_ent)->sum('mttc_pay');
        $tva = Paiement::where('paiements.id_ent','=',Auth::user()->id_ent)->sum('tva_pay');
        $depenses = Depense::where('depenses.id_ent','=',Auth::user()->id_ent)->sum('amount_dep');
        $year_paiements = array();
        $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
        foreach ($months as $month) {
            
            $time=strtotime(now());
            $year=date("Y",$time);
            $year_pay = Paiement::where('paiements.id_ent','=',Auth::user()->id_ent)
            ->whereYear('paiements.date_pay','=',$year)
            ->whereMonth('paiements.date_pay','=',$month)->sum('mttc_pay');
            array_push($year_paiements,$year_pay);
            
        }
        //dd($year_paiements);
        return view('home',['user'=> $user,'products'=> $products,
        'paiements'=> $paiements,'depenses'=> $depenses,'tva'=> $tva,'year_paiements'=>$year_paiements]);
    }


    public function profile()
    {
        /** @var Application $application */
     
        $user = Auth::user();

        $historic = new HistoricService();
        $historic->Add('View profile');
        $lst_histos = $historic->HistoricsUser($user->id);

        return view('user.profile', ['user'=> $user,'lst_histos'=>$lst_histos]);
    }
    
    
}
