<?php

namespace App\Http\Controllers;

use App\Models\Cat_produit;
use App\Models\Produit;
use App\Services\DecodeService;
use App\Services\HistoricService;
use App\Services\ProduitService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;

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
        if (request()->ajax()) {

            $tasks = Produit::select(
                'produits.id',
                'code_prod',
                'name_prod',
                'desc_prod',
                'price_prod',
                'qty_prod',
                'cat_name',
                'detail',
                'status',
                'img'
            )
                ->join('cat_produits', 'cat_produits.id', '=', 'produits.id_cat')
                ->where('produits.id_ent', '=', Auth::user()->id_ent)->get();

            return datatables()->of($tasks)
                ->addColumn('action', function ($row) {

                    // Update Button
                    $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/produit/show/" . $row->id . "'><i class='bx bxs-detail'></i></a>";
                    // Update Button
                    $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/produit/edit/" . $row->id . "'><i class='bx bxs-edit'></i></a>";
                    // Delete Button
                    //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/produit/destroy/" . $row->id . "'><i class='bx bxs-trash'></i></a>";

                    return $updateButton . " " . $showButton;
                })

                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        $cats = Cat_produit::all();
        $historic = new HistoricService();
        $historic->Add('List products');

        return view('produit.listProduit', ['cats' => $cats]);
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
        $validator = Validator::make($request->all(), [
            'code_prod' => ['required'],
            'name_prod' => ['required'],
            'desc_prod' => ['required'],
            'price_prod' => ['required'],
            'id_cat' => ['required'],
            'qty_prod' => ['required'],
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id_cat);

        $image = $request->file('img');
        $imageName = time() . '.' . $image->extension();

        $destinationPathThumbnail = public_path('/thumbnail');
        $img = Image::make($image->path());
        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPathThumbnail . '/' . $imageName);

        $destinationPath = public_path('/products/images');
        $image->move($destinationPath, $imageName);
        //dd($request);

        //insert product datas
        $pro = new ProduitService();
        $pro->CreateProduit(
            $request->code_prod,
            $request->name_prod,
            $request->desc_prod,
            $request->price_prod,
            $request->qty_prod,
            $request->color_prod,
            $request->size_prod,
            $request->detail,
            $decoded_id,
            $request->volume,
            $request->poids,
            $request->is_stock,
            $request->neuf,
            $imageName
        );

        $historic = new HistoricService();
        $historic->Add('Add new product');

        return redirect()->back()->with('success', 'Produit ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $prod = Produit::find($decoded_id);

        $historic = new HistoricService();
        $historic->Add('View detail product');

        //dd($ent);
        return view('produit.detailProduit', ['prod' => $prod]);
    }

    public function ajaxShow($id)
    {
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $prod = Produit::find($decoded_id);

        //dd($ent);
        return json_decode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $prod = Produit::find($decoded_id);

        $historic = new HistoricService();
        $historic->Add('Edit product');

        //dd($prod);
        $cats = Cat_produit::all();
        return view('produit.editProduit', ['prod' => $prod,'cats' => $cats]);
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
        //dd($request);
        $validator = Validator::make($request->all(), [
            'code_prod' => ['required'],
            'name_prod' => ['required'],
            'desc_prod' => ['required'],
            'price_prod' => ['required'],
            'id_cat' => ['required'],
            'qty_prod' => ['required']
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id_cat);
        $decodprod_id = $decode->DecodeId($request->id);
        if($request->file('img') !=null){
            $image = $request->file('img');
            $imageName = time() . '.' . $image->extension();

            $destinationPathThumbnail = public_path('/thumbnail');
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $imageName);

            $destinationPath = public_path('/products/images');
            $image->move($destinationPath, $imageName);
        }else
        //dd($request);

        //update product datas

        $pro = Produit::find($decodprod_id);
        //dd($pro);
            $pro->code_prod = $request->code_prod;
            $pro->name_prod = $request->name_prod;
            $pro->desc_prod = $request->desc_prod;
            $pro->price_prod = $request->price_prod;
            $pro->qty_prod = $request->qty_prod;
            $pro->color_prod = $request->color_prod;
            $pro->size_prod = $request->size_prod;
            $pro->detail = $request->detail;
            $pro->volume = $request->volume;
            $pro->poids = $request->poids;
            $pro->is_stock = $request->is_stock;
            $pro->neuf = $request->neuf;
            $pro->id_cat = $decoded_id;
            if($request->file('img') !=null){
            $pro->img = $request->$imageName;}
            $pro->save();

        $historic = new HistoricService();
        $historic->Add('update a product');

        return redirect()->route('produit.main')->with('success','Produit modifié avec succes');

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
        return redirect()->back()->with('success', 'Produit supprimé');
    }
}
