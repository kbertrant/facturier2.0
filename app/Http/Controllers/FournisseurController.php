<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Services\FournisseurService;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
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
            $tasks = Fournisseur::select('fournisseurs.id','four_name','four_code','four_adress','four_phone',
            'four_stat','resp_name','four_rccm','four_nui','four_email')
            ->where('fournisseurs.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/fournisseur/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/fournisseur/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List providers');

       return view('fournisseur.listFour');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
       $validator =  Validator::make($request->all(),[
            'four_name' => ['required','unique:fournisseurs'],
            'four_code' => ['required'],
            'resp_name' => ['required'],
            'four_rccm' => ['required'],
            'four_nui' => ['required'],
            'four_phone' => ['required'],
            'four_email' => ['required'],
        ]); 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $four = new FournisseurService();
        $four->CreateFournisseur($request->four_name,$request->four_code,$request->resp_name,
        $request->four_rccm,$request->four_nui,$request->four_phone,$request->four_email,
        $request->four_adress);

        $historic = new HistoricService();
        $historic->Add('Add new provider');

        return redirect()->back()->with('success','Fournisseur ajouté');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    //
}
