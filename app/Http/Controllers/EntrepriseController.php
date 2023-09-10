<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = Entreprise::all();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/ent/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/ent/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton."".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('ent.ent');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
        $ent = Entreprise::findOrFail();
        $ent->name_ent = $request->get('name_ent');
        $ent->rc_ent = $request->get('rc_ent');
        $ent->nc_ent = $request->get('nc_ent');
        $ent->phone_ent = $request->get('phone_ent');
        $ent->address_ent = $request->get('address_ent');
        $ent->owner_ent = $request->get('owner_ent');
        $ent->bank_ent = $request->get('bank_ent');
        $ent->save();
        //return $product;
        return redirect('ent')->with('success','Entreprise Ajoutée !');
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
    public function update(Request $request)
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
