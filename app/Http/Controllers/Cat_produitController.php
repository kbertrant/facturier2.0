<?php

namespace App\Http\Controllers;

use App\Models\Cat_produit;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Cat_produitController extends Controller
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
    
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = Cat_produit::where('id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-1 viewdetails' data-id='".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-1' href='/categories/edit/".$row->id."'><i class='bx bxs-edit'></i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-1' href='/cat/produit/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $historic = new HistoricService();
        $historic->Add('List cat product');

        return view('cat_produit.listCat_produit');
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
        Validator::make($request->all(),[
            'cat_name' => ['required'],
        ]); 
        $catpro = new Cat_produit();
        $catpro->cat_name = $request->cat_name;
        $catpro->cat_stat = 'A';
        $catpro->id_ent = Auth::user()->id_ent;
        $catpro->save();

        $historic = new HistoricService();
        $historic->Add('Add Category product');

        return redirect()->back()->with('success','Categorie ajoutée');
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
        $categorie = Cat_produit::find($id);
        $categorie->delete();
        return redirect()->back()->with('success','categorie supprimée');
    }
    
}
