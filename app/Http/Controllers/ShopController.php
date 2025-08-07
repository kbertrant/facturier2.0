<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Services\HistoricService;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
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
            $tasks = Shop::select('shops.id','name_shop','address_shop','name_ent')
            ->join('entreprises','entreprises.id','=','shops.id_ent')
            ->where('shops.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/shop/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/fournisseur/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton;
                 
         })
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List shops');

       return view('shop.listShop');
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
        //dd($request);
        $validator =  Validator::make($request->all(),[
            'name_shop' => ['required'],
            'address_shop' => ['required'],
        ]); 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $sh = new ShopService();
        $sh->Add($request->name_shop,$request->address_shop,Auth::user()->id_ent);

        $historic = new HistoricService();
        $historic->Add('Add new shop');

        return redirect()->back()->with('success','Boutique ajoutée');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shop  $c
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $c)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shop  $c
     * @return \Illuminate\Http\Response
     */
    public function edit(Shop $c)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shop  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shop $c)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shop  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $c)
    {
        //
    }
}
