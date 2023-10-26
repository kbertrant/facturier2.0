<?php

namespace App\Http\Controllers;

use App\Models\Cat_produit;
use App\Models\Produit;
use App\Services\ProduitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
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

            $tasks = Produit::select('produits.id','code_prod','name_prod','desc_prod','price_prod','qty_prod','cat_name','type_content','detail','status')
            ->join('cat_produits','cat_produits.id','=','produits.id_cat')
            ->where('produits.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i data-lucide='plus' class='w-5 h-5'>Voir</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/produit/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/produit/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        $cats = Cat_produit::all();
        return view('produit.listProduit',['cats'=>$cats]);
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
            'code_prod' => ['required'],
            'name_prod' => ['required'],
            'desc_prod' => ['required'],
            'price_prod' => ['required'],
            'id_cat' => ['required'],
            'qty_prod' => ['required'],
        ]); 
        $pro = new ProduitService();
        $pro->CreateProduit($request->code_prod,$request->name_prod,$request->desc_prod,$request->price_prod,$request->color_prod,$request->size_prod,
        $request->type_content,$request->detail,$request->qty_prod,$request->id_cat);


        return redirect()->back()->with('success','Produit ajouté');
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
        $prod = Produit::find($id);
        $prod->delete();
        return redirect()->back()->with('success','Produit supprimé');
    }
}
