<?php

namespace App\Http\Controllers;

use App\Services\HistoricService;
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
        
        return view('home');
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
