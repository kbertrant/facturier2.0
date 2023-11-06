<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EntrepriseController extends Controller
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
    
    public function index()
    {
       /** @var Application $application */
         
          $user= Auth::user();

        //  $entreprise = DB::table('entreprises')
        //                 ->select()
        //                 ->join($user,'entrprises.id','=',$user->ent_id)
        //                 ;
       $entreprise =Entreprise::where('id','=',$user->id_ent)->first();
    
        return view('entreprise.ent',[
            
            'entreprise'=>$entreprise
        ]);

    }


    
    public function update(Request $request)
    {
        Validator::make($request->all(),[

            'name_ent' => ['required','unique:entreprises'],
            'rc_ent' => ['required','unique:entreprises'],
            'nc_ent' => ['required','unique:entreprises'],
            'phone_ent' => ['required'],
            'address_ent' => ['required'],
            'owner_ent' => ['required'],
            'bank_ent' => ['required'],
            'logo_ent' => ['required'],

        ]); 

        $entreprise =Entreprise::find($request->id) ;
    
        
        if($entreprise->logo_ent){Storage::disk('public')->delete($entreprise->logo_ent);}
        
        if($request->logo_ent){
        $logoPath = $request->file('logo_ent')->store('logo','public');
        $entreprise->logo_ent=$logoPath;
        }
        

        $entreprise->update([
             'name_ent'=>$request->name_ent,
             'rc_ent'=>$request->rc_ent,
             'nc_ent'=>$request->nc_ent,
             'phone_ent'=>$request->phone_ent,
             'address_ent'=>$request->address_ent,
             'owner_ent'=>$request->owner_ent,
             'bank_ent'=>$request->bank_ent,
             'logo_ent'=>$logoPath

        ]);
        
         return redirect()->route('entreprise')->with('success','Entreprise Ajoutée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ent = Entreprise::find($id);
        return view('ent.up-ent',['ent'=>$ent]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function yt(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ent' => ['required'],
            'rc_ent' => ['required'],
            'nc_ent' => ['required'],
            'phone_ent' => ['required'],
            'address_ent' => ['required'],
            'owner_ent' => ['required'],
            'bank_ent' => ['required'],
        ]);
        //dd($request);
        if ($validator->fails()) {
            return redirect('ent')
                        ->withErrors($validator)
                        ->withInput();
        }
        //dd($request);
        
        $ent = Entreprise::findOrFail($request->id);
        $ent->name_ent = $request->get('name_ent');
        $ent->rc_ent = $request->get('rc_ent');
        $ent->nc_ent = $request->get('nc_ent');
        $ent->phone_ent = $request->get('phone_ent');
        $ent->address_ent = $request->get('address_ent');
        $ent->owner_ent = $request->get('owner_ent');
        $ent->bank_ent = $request->get('bank_ent');
        $ent->save();
        //return $product;
        return redirect('ent')->with('success','Entreprise modifiée !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ent = Entreprise::find($id);
        $ent->delete();
        return redirect('ent')->with('success','Entreprise supprimée');
    }
}
