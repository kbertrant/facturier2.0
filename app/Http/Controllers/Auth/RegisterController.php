<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Tresorerie;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use App\Services\DecodeService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['string', 'min:9','unique:users'],
            'ville' => ['string'],
            'name_ent' => ['string','unique:entreprises'],
            'rc_ent' => ['string','unique:entreprises'],
            'image' => ['required','image'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try { 
            DB::beginTransaction();
            $ent = Entreprise::create([
                'name_ent'=> $data['name_ent'],
                'rc_ent'=> $data['rc_ent'],
            ]); 
            
            $myimage = $data['image']->getClientOriginalName();
            if($data['image']){
            $imagePath = ($data['image'])->move(public_path('images'), $myimage);
            }

            $decode = new DecodeService();
            $decoded_id = $decode->DecodeId($ent->id);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'ville' => $data['ville'],
                'image'=> $imagePath,
                'role'=> 'admin',
                'id_ent'=>$decoded_id,
                'password' => Hash::make($data['password'])
            ]);

            $ep = new Tresorerie();
            $ep->amount = 0;
            $ep->amount_tres = 0;
            $ep->mouvement = "IN";
            $ep->date_tres = now();
            $ep->id_ent = $user->id_ent;
            $ep->save();
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return $user;
           
    }
}
