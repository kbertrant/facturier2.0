<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\Controller;
use App\Models\Entreprise;
use App\Models\Setting;
use App\Models\Shop;
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

            $myimage = $data['image']->getClientOriginalName();
            if($data['image']){
            $imagePath = ($data['image'])->move(public_path('entreprises'), $myimage);
            }

            $ent = Entreprise::create([
                'name_ent'=> $data['name_ent'],
                'rc_ent'=> $data['rc_ent'],
                'phone' => $data['phone'],
                'regim_fiscal_ent'=> $data['regime_fisc'],
                'logo_ent'=>'logo_ent.jpeg'
            ]); 
            $decode = new DecodeService();
            $ent_id = $decode->DecodeId($ent->id);

            $shop = Shop::create([
                'name_shop'=> 'Shop 1',
                'address_shop'=> $data['name_ent'],
                'id_ent'=> $ent_id
            ]); 

            $shop = Setting::create([
                'template_inv'=> 'default',
                'print_format'=> 'A4',
                'id_ent'=> $ent_id
            ]); 
            
            

            $startDate = time();
            
            
            $shop_id = $decode->DecodeId($shop->id);
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'ville' => $data['ville'],
                'role'=> 'admin',
                'id_ent'=>$ent_id,
                'id_shop'=>$shop_id,
                'id_cur'=>$data['id_cur'],
                'exp_date'=> date('Y-m-d H:i:s', strtotime('+7 days', $startDate)),
                'password' => Hash::make($data['password'])
            ]);

            $user->assignRole('admin');

            $ep = new Tresorerie();
            $ep->amount = 0;
            $ep->amount_tres = 0;
            $ep->mouvement = "IN";
            $ep->date_tres = now();
            $ep->id_ent = $user->id_ent;
            $ep->id_cur = $data['id_cur'];
            $ep->save();
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return $user;
           
    }
}
