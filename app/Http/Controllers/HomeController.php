<?php

namespace App\Http\Controllers;

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
        
      /** @var Application $application */
        $id = Auth::user()->id;
        $user = Auth::user();
       
        return view('home',['user'=>$user]);
    }

    public function profile()
    {
        /** @var Application $application */
        $id = Auth::user()->id;
        $user = Auth::user();

        return view('user.profile', ['user'=> $user]);
    }
    
    
}
