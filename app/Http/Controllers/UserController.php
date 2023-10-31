<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\User;
use App\Notifications\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

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
            $tasks = User::select('users.id','name','email','ville','phone','name_ent','users.stat')
            ->join('entreprises','entreprises.id','=','users.id_ent')->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/user/show/".$row->id."' ><i data-lucide='plus' class='w-5 h-5'>Details </i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/user/edit/".$row->id."' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/user/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
       return view('user.listUser');
    }
    

    protected function store(Request $request)
    {
    
        $ent = Entreprise::create([
            'name_ent'=> $request->name_ent,
            'rc_ent'=> $request->rc_ent,
        ]); 
        
        
        if($request->image){
          $imagePath = ($request->imag)->store('images', 'public');
        }

         $user=User::create([
            'name' => $request->name,
            'email' => $request['email'],
            'phone' => $request['phone'],
            'ville' => $request['ville'],
            'image'=> $imagePath,
            'id_ent'=>$ent->id,
            'password' => Hash::make($request->password)
        ]);

        
        $user->notify(new UserNotification());
       
        return view('user.listUser');

    }


    public function update(Request $request){
        
        
          Validator::make($request->all(), [
            'name' => ['required','string','unique:users'],
            'email' => ['required','string','unique:users'],
            'anc_password' => ['required','string'],
            'new_password' => ['required','min:8','string'],
            'ville' => ['required','string'],
            'phone' => ['required','string','unique:users'],
            'image'=>['required']
        ]);

        $user =User::find($request->id) ;
    
        
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
                'image'=>$imagePath
            ]);
        } 
         return redirect()->route('profile');
    }
}
