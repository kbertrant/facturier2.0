<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Depense;
use App\Models\Entreprise;
use App\Models\Fournisseur;
use App\Models\User;
use App\Services\DecodeService;
use App\Services\DepenseService;
use App\Services\HistoricService;
use App\Services\TresorService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
                
                return $showButton;
                 
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
        //dd($request);
        $validator = Validator::make($request->all(),[
            'amount_dep' => ['required'],
            'label_dep' => ['required'],
            'solde_dep' => ['required'],
            'mode_dep' => ['required'],
            'id_four' => ['required'],
        ]); 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $date = now();
        $ref_dep = $date->format('ymdHis');
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id_four);

        $tresor = new TresorService();
        $tresor->transac($request->amount_dep,"OUT");

        $cli = new DepenseService();
        $cli->CreateDepense($ref_dep,$request->amount_dep,$request->label_dep,$request->solde_dep,
        $request->mode_dep,$decoded_id);

        $historic = new HistoricService();
        $historic->Add('Add new expense');

        return redirect()->back()->with('success','Nouvelle depense');
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
        $dep = Depense::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $four = Fournisseur::find($dep->id_four);
        $usr = User::find($dep->id_usr);

        $historic = new HistoricService();
        $historic->Add('Detail expense ');
        return view('depense.detailDepense',['dep'=>$dep,'four'=>$four,'ent'=>$ent,'usr'=>$usr]);
    
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
    
    public function generatePDF($id){

        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $dep = Depense::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $four = Fournisseur::find($dep->id_four);
        $usr = User::find(Auth::user()->id);

        $pdf = Pdf::loadView('print.deppdf', [
            'dep' => $dep,
            'ent' => $ent,
            'four' => $four,
            'usr' => $usr,
        ])->setPaper('a6')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        $historic = new HistoricService();
        $historic->Add('Print depense');
        return $pdf->download('DEP_'.$dep->ref_dep.'.pdf');
        
    }
}
