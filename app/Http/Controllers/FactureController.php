<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\Produit;
use App\Models\User;
use App\Services\ClienteService;
use App\Services\DecodeService;
use App\Services\EltFactureService;
use App\Services\FactureService;
use App\Services\HistoricService;
use App\Services\ProduitService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

class FactureController extends Controller
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

            $tasks = Facture::select('factures.id','ref_fac','date_fac','mttc_fac','qty_fac','stat_fac',
            'name_cli')
            ->join('clientes','clientes.id','=','factures.id_cli')
            ->where('factures.id_ent','=',Auth::user()->id_ent)->orderBy('date_fac', 'desc')->get();
            
            return datatables()->of($tasks)
            ->addColumn('stat_fac', function ($row) {
                if($row->stat_fac == "Pending"){
                $span = "<span class='badge bg-label-danger'>".$row->stat_fac."</span>";
                }else{$span = "<span class='badge bg-label-success'>".$row->stat_fac."</span>";}
                return  $span;})
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2' href='/facture/show/".$row->id."' ><i class='bx bxs-detail'></i></a>";
                // Update Button
                //$updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/facture/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                
                return $showButton;
                 
         })
         
            ->rawColumns(['stat_fac','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $clients = Cliente::where('clientes.id_ent','=',Auth::user()->id_ent)->get();
        $produits = Produit::where('produits.id_ent','=',Auth::user()->id_ent)->get();

        $historic = new HistoricService();
        $historic->Add('List invoices');
        
        return view('facture.listFacture',['clients'=>$clients,'produits'=>$produits]);
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
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'reduction' => ['required']
        ]); 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try { 
            DB::beginTransaction();
            //formar date 
            $decode = new DecodeService();
            $date = now();
            $result = $date->format('ymdHis');
            //get client informations
            $cli = Cliente::where('name_cli','LIKE',$request->id_cli)->first();
            if($cli == null){
                $cliservice = new ClienteService();
                $cli = $cliservice->CreateCliente($request->id_cli,'phone','Adresse',null,null,null,null,1);
                //dd($cli);
            }
            //create facture to null
            $fac = new FactureService();
            $dcod_cli_id = $decode->DecodeId($cli->id);
            $new_fac = $fac->CreateFacture($dcod_cli_id,null,$result,0,0,0,0,0,$request->reduction);
            $dcod_fac_id = $decode->DecodeId($new_fac->id);
            $s = 0;
            //add elements facture
            foreach ($request->id_prod as $pr) {
                $i = $s++;
                if($pr!=null){
                    $prix_unit = $request->your_price[$i];
                    $p = $decode->DecodeId($pr);
                    $pro = new ProduitService();
                    $pro->decrementQteProduct($request->quantity[$i],$p);

                    if($prix_unit == 0){
                        $prix_unit = $pro->getPriceProduct($p);
                    }
                    $prod = Produit::find($p);
                    $ef = new EltFactureService();
                    //$dcode_fac_id = Hashids::decode($new_fac->id);
                    $ef->CreateEltFacture($p,$dcod_fac_id,$request->quantity[$i],$prix_unit,$request->quantity[$i]*$prix_unit,$prod->name_prod,$prix_unit);
                    
                }
            }

            //sum amount of elt facturation and quantity
            $mht = ElementFacture::where('id_fac','=',$dcod_fac_id)->sum('ef_ttc');
            $all_qty = ElementFacture::where('id_fac','=',$dcod_fac_id)->sum('ef_qty');
            //dd($mht);
            //calcul reduction if exist
            $red = $fac->GetReduction($mht, $request->reduction);
            $amountRed = $mht - $red; 
            //dd($amountRed);
            //set value of deducted at source
            if($request->rs_apply=="on"){
                $rs = $fac->GetRSValue($amountRed,$request->tva_apply);
                //dd($rs);
            }else{$rs = 0;}
            //amount ht IR deducted
            $amountIR = $amountRed - $rs;
            //dd($amountIR);
            //apply TVA if existed
            if($request->tva_apply=="on"){
                $tva = $fac->GetTVAValue($amountIR);
            }else{$tva = 0;} 
            //dd($tva);
            // set facture with prices
            $up_fac = $fac->SetPriceFacture($dcod_fac_id,$amountIR,$mht,$tva,$all_qty,$red,$rs);

            $historic = new HistoricService();
            $historic->Add('Add new invoice');

            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return redirect()->back()->with('success','Facture ajoutée');
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
        $fac = Facture::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$decoded_id)->get();
        
        $usr = User::find($fac->id_usr);
        $cl = Cliente::find($fac->id_cli);
        //dd($efs);
        return view('facture.detailFacture',['fac'=>$fac,'efs'=>$efs,'cl'=>$cl,'ent'=>$ent,'usr'=>$usr]);
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
        $fac = Facture::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$decoded_id)->get();
        $cl = Cliente::find($fac->id_cli);
        $usr = User::find(Auth::user()->id);

        $pdf = Pdf::loadView('print.facpdf', [
            'fac' => $fac,
            'ent' => $ent,
            'efs' => $efs,
            'cl' => $cl,
            'usr' => $usr,
        ])->setPaper('a4')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        
        return $pdf->download('FAC_'.$fac->ref_fac.'.pdf');
        //return $pdf->stream();
    }


    public function facturesClient($cli_id)
    {
        if(request()->ajax()) {
            //dd($cli_id);
            $tasks = Facture::select('factures.id','ref_fac','date_fac','mttc_fac','stat_fac')
            ->where('factures.id_cli','=',$cli_id)->get();
            
            return datatables()->of($tasks)
            ->addColumn('stat_fac', function ($row) {
                if($row->stat_fac == "Pending"){
                $span = "<span class='badge bg-label-danger'>".$row->stat_fac."</span>";
                }else{$span = "<span class='badge bg-label-success'>".$row->stat_fac."</span>";}
                return  $span;})
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2' href='/facture/show/".$row->id."' ><i class='bx bxs-detail'></i></a>";
                
                return $showButton;
                 
         })
         
            ->rawColumns(['stat_fac','action'])
            ->addIndexColumn()
            ->make(true);
        }
        
        return view('client.detailClient');
    }
}
