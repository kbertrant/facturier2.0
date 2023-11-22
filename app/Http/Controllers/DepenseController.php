<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Depense;
use App\Models\Fournisseur;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepenseController extends Controller
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

            $tasks = Depense::select('depenses.id','ref_dep','date_dep','amount_dep','status',
            'label_dep','four_name')
            ->join('fournisseurs','fournisseurs.id','=','depenses.id_four')
            ->where('depenses.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('status', function ($row) {
                if($row->status == "Pending"){
                $span = "<span class='badge bg-label-danger'>".$row->status."</span>";
                }else{$span = "<span class='badge bg-label-success'>".$row->status."</span>";}
                return  $span;})
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2' href='/depense/show/".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/depense/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                
                return $updateButton." ".$showButton;
                 
         })
         
            ->rawColumns(['status','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $fours = Fournisseur::where('fournisseurs.id_ent','=',Auth::user()->id_ent)->get();
        
        $historic = new HistoricService();
        $historic->Add('List Expenses');
        
        return view('depense.listDepense',['fours'=>$fours]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
