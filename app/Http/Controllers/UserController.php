<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Entreprise;
use App\Models\Shop;
use App\Models\User;
use App\Notifications\UserNotification;
use App\Services\DecodeService;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
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

    public function index(){
        if(request()->ajax()) {
            $tasks = User::select('users.id','name','email','ville','phone','name_ent','users.stat','exp_date','name_shop')
            ->join('entreprises','entreprises.id','=','users.id_ent')
            ->join('shops','shops.id','=','users.id_shop')
            ->where('users.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/user/show/".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/user/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/user/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List users');

        $roles = Role::pluck('name','name')->all();
        $shops = Shop::where('id_ent',Auth::user()->id_ent)->get();
        
       return view('user.listUser',['roles'=>$roles,'shops'=>$shops]);
    }

    public function listAdmin(){
        if(request()->ajax()) {
            $tasks = User::select('users.id','name','email','ville','phone','name_ent','users.stat','exp_date','name_shop')
            ->join('entreprises','entreprises.id','=','users.id_ent')->join('shops','shops.id','=','users.id_shop')->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/user/show/".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/user/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/user/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List users');
        $historic = new HistoricService();
        $historic->Add('List users');

        $roles = Role::pluck('name','name')->all();
        $shops = Shop::where('id_ent',Auth::user()->id_ent)->get();
        
       return view('user.listallusers',['roles'=>$roles,'shops'=>$shops]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$decode = new DecodeService();
        //$decoded_id = $decode->DecodeId($id);
        $user = Employee::find($id);
        $ent = Entreprise::find($user->id_ent);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        
        //dd($ent);
        return view('user.editUser',['ent'=>$ent,'user'=>$user,'roles'=>$roles,'userRole'=>$userRole]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'name' => ['required','string','unique:users'],
            'email' => ['required','string','unique:users'],
            'password' => ['required','string'],
            'ville' => ['required','string'],
            'phone' => ['required','string','unique:users'],
            'exp_date'=>['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $decode = new DecodeService();
        $decoded_id_shop = $decode->DecodeId($request['id_shop']);

        $user=Employee::create([
            'name' => $request->name,
            'email' => $request['email'],
            'phone' => $request['phone'],
            'ville' => $request['ville'],
            'role' => $request->roles[0],
            'id_ent'=> Auth::user()->id_ent,
            'id_shop'=> $decoded_id_shop,
            'password' => Hash::make($request->password),
            'exp_date'=> $request->exp_date
        ]);
        $user->assignRole($request->input('roles'));

        $historic = new HistoricService();
        $historic->Add('Add new user');
        
        return redirect()->back()->with('success','Utilisateur ajouté');

    }


    public function update(Request $request){
        
        
          $validator = Validator::make($request->all(), [
            'name' => ['required','string','unique:users'],
            'email' => ['required','string','unique:users'],
            'anc_password' => ['required','string'],
            'new_password' => ['required','min:6','string'],
            'ville' => ['required','string'],
            'phone' => ['required','string','unique:users'],
            'image'=>['required'],'exp_date'=>['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user =Employee::find($request->id) ;
    
        
        if($user->image){Storage::disk('public')->delete($user->image);}
        
        if($request->image){
           $imagePath = $request->file('image')->store('images','public');
           $user->image=$imagePath;
        }

        $hashedpassword = $user->password;
        $anc_password= $request->anc_password;
        $new_password= $request->new_password;
        
        if(password_verify($anc_password, $hashedpassword)){

            $user->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($new_password),
                'ville'=>$request->ville,
                'phone'=>$request->phone,
                'image'=>$imagePath,
                'role' => $request->role,
                'exp_date' => $request->exp_date,
            ]);
        } 

        $historic = new HistoricService();
        $historic->Add('Update client');

         return redirect()->route('profile');
    }
}
