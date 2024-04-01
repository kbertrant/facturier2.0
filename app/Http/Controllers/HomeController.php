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
        $time=strtotime(now());
        $year=date("Y",$time);
        $month=date("m",$time);
        $day=date("d",$time);
        $day_pay = Paiement::where('paiements.id_ent','=',Auth::user()->id_ent)
                ->whereYear('paiements.date_pay','=',$year)
                ->whereMonth('paiements.date_pay','=',$month)
                ->whereDay('paiements.date_pay','=',$day)
                ->sum('mttc_pay');
        $day_dep = Depense::where('depenses.id_ent','=',Auth::user()->id_ent)
                ->whereYear('depenses.date_dep','=',$year)
                ->whereMonth('depenses.date_dep','=',$month)
                ->whereDay('depenses.date_dep','=',$day)
                ->whereMonth('depenses.date_dep','=',$month)->sum('amount_dep');
        
            $data = [
            'labels' =>['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul','Aug','Sep','Oct','Nov','Dec'],
            'payments'=>[],
            'depenses'=>[]];
            $months = array(1,2,3,4,5,6,7,8,9,10,11,12);
            foreach ($months as $month) {
                
                $time=strtotime(now());
                $year=date("Y",$time);
                $year_pay = Paiement::where('paiements.id_ent','=',Auth::user()->id_ent)
                ->whereYear('paiements.date_pay','=',$year)
                ->whereMonth('paiements.date_pay','=',$month)->sum('mttc_pay');
                array_push($data['payments'],$year_pay);

                $year_dep = Depense::where('depenses.id_ent','=',Auth::user()->id_ent)
                ->whereYear('depenses.date_dep','=',$year)
                ->whereMonth('depenses.date_dep','=',$month)->sum('amount_dep');
                array_push($data['depenses'],$year_dep);
            }
        
        //dd($data);
        return view('home',['user'=> $user,'products'=> $products,
        'paiements'=> $paiements,'depenses'=> $depenses,'tva'=> $tva,
        'data'=>$data,'day_dep'=>$day_dep,'day_pay'=>$day_pay]);
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
