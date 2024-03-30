<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\Paiement;
use App\Models\Proformas;
use App\Models\User;
use App\Services\DecodeService;
use App\Services\HistoricService;
use App\Services\PaiementService;
use App\Services\TresorService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class PaiementController extends Controller
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

            $tasks = Paiement::select('paiements.id as id','ref_pay','date_pay','mttc_pay','stat_pay',
            'name_cli')
            ->join('clientes','clientes.id','=','paiements.id_cli')
            ->where('paiements.id_ent','=',Auth::user()->id_ent)
            //->published()
            ->get();
            
            return datatables()->of($tasks)
            ->addColumn('stat_pay', function ($row) {
                return $span = "<span class='badge bg-label-success'>".$row->stat_pay."</span>";})
            ->addColumn('action', function($row){
   
                // Show Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/payment/show/".$row->id."'><i class='bx bxs-detail'></i></a>";
               
                return $showButton;
                 
         })
         
            ->rawColumns(['stat_pay','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $facs = Facture::where('factures.id_ent','=',Auth::user()->id_ent)->where('factures.stat_fac','=','Pending')
        ->join('clientes','clientes.id','=','factures.id_cli')
        ->select('ref_fac as ref','mttc_fac as mttc','name_cli')->get();
        
        $historic = new HistoricService();
        $historic->Add('List paiement');
        return view('payment.listPayment',['facs'=>$facs]);
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
            'num_fac' => ['required'],
            'pay_mode' => ['required'],
            'mttc_pay' => ['required']
        ]); 
        try { 
            DB::beginTransaction();
            $decode = new DecodeService();

            $date = now();
            $ref_pay = $date->format('ymdHis');

            //update invoice before create receipt
            $fac = Facture::where('ref_fac','LIKE',$request->num_fac)->first();
            $fac->stat_fac = "Paid";
            $fac->save();
            $decode = new DecodeService();
            $decoded_id = $decode->DecodeId($fac->id);
            //dd($fac);
            $solde_pay = $fac->mttc_fac - $request->mttc_pay;
            $payment = new PaiementService();
            $pay = $payment->Paid($ref_pay,$decoded_id,$request->mttc_pay,$request->pay_mode,$solde_pay,$fac->id_cli);
            //dd($pay);
            $tresor = new TresorService();
            $tresor->transac($request->mttc_pay,"IN");

            $historic = new HistoricService();
            $historic->Add('Add new payment');
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }

        return redirect()->back()->with('success','Nouveau paiement effectué!');
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
        $pay = Paiement::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$pay->id_fac)->get();
        $cl = Cliente::find($pay->id_cli);
        $usr = User::find($pay->id_usr);

        $historic = new HistoricService();
        $historic->Add('Detail payment ');
        return view('payment.detailPayment',['pay'=>$pay,'efs'=>$efs,'cl'=>$cl,'ent'=>$ent,'usr'=>$usr]);
    
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
        $pay = Paiement::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$pay->id_fac)->get();
        $cl = Cliente::find($pay->id_cli);
        $usr = User::find(Auth::user()->id);

        $pdf = Pdf::loadView('print.paypdf', [
            'pay' => $pay,
            'ent' => $ent,
            'efs' => $efs,
            'cl' => $cl,
            'usr' => $usr,
        ])->setPaper('a6')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        $historic = new HistoricService();
        $historic->Add('Print receipt payment');
        return $pdf->download('PAY_'.$pay->ref_pay.'.pdf');
        
    }
}
