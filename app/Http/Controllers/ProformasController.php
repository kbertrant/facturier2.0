<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\ElementProforma;
use App\Models\Entreprise;
use App\Models\Produit;
use App\Models\Proformas;
use App\Models\User;
use App\Services\ClienteService;
use App\Services\DecodeService;
use App\Services\EltProformaService;
use App\Services\HistoricService;
use App\Services\ProduitService;
use App\Services\ProformaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\DB;

class ProformasController extends Controller
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

            $tasks = Proformas::select(
                'proformas.id',
                'pro_ref',
                'date_pro',
                'mttc_pro',
                'qty_pro',
                'stat_pro',
                'name_cli'
            )
                ->join('clientes', 'clientes.id', '=', 'proformas.id_cli')
                ->where('proformas.id_ent', '=', Auth::user()->id_ent)->orderBy('date_pro', 'desc')->get();

            return datatables()->of($tasks)
                ->addColumn('stat_pro', function ($row) {
                    if ($row->stat_pro == "Pending") {
                        $span = "<span class='badge bg-label-danger'>" . $row->stat_pro . "</span>";
                    } else {
                        $span = "<span class='badge bg-label-success'>" . $row->stat_pro . "</span>";
                    }
                    return  $span;
                })
                ->addColumn('action', function ($row) {

                    // Show Button
                    $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/proforma/show/" . $row->id . "'><i class='bx bxs-detail'></i></a>";
                    // Update Button
                    if ($row->stat_pro == "Pending") {
                        $updateButton = "<a class='btn btn-sm btn-info  mr-1 mb-2' href='/proforma/edit/" . $row->id . "' ><i class='bx bxs-edit'></i></a>";
                    }
                    // Delete Button
                    //$deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/proforma/validate/" . $row->id . "'><i class='bx bxs-stick'></i></a>";
                    if ($row->stat_pro == "Pending") {
                        return $updateButton . " " . $showButton;
                    }else{return $showButton;}
                })

                ->rawColumns(['stat_pro', 'action'])
                ->addIndexColumn()
                ->make(true);
        }
        $clients = Cliente::where('clientes.id_ent', '=', Auth::user()->id_ent)->get();
        $produits = Produit::where('produits.id_ent', '=', Auth::user()->id_ent)->get();

        $historic = new HistoricService();
        $historic->Add('List proformas');

        return view('proforma.listProforma', ['clients' => $clients, 'produits' => $produits]);
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
        Validator::make($request->all(), [
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'reduction' => ['required']
        ]);
        try { 
            DB::beginTransaction();
            $decode = new DecodeService();
            $date = now();
            $result = $date->format('ymdHis');
            $cli = Cliente::where('name_cli', 'like', $request->id_cli)->first();
            
            if($cli == null){
                $cliservice = new ClienteService();
                $cli = $cliservice->CreateCliente($request->id_cli,'phone','Adresse',null,null,null,null,1);
                //dd($cli);
            }
            $dcod_cli_id = $decode->DecodeId($cli->id);
            $prof = new ProformaService();
            $new_prof = $prof->CreateProforma($dcod_cli_id, $result, 0, 0, 0, 0, $request->reduction);
            $dcode_pro_id = $decode->DecodeId($new_prof->id);
            $s = 0;
            foreach ($request->id_prod as $pr) {
                $p = $decode->DecodeId($pr);
                $i = $s++;
                if ($p != null) {

                    $pro = new ProduitService();
                    $pro->decrementQteProduct($request->quantity[$i], $p);

                    $prix_unit = $pro->getPriceProduct($p);

                    $ep = new EltProformaService();
                    $ep->CreateEltProforma($p, $dcode_pro_id, $request->quantity[$i], $prix_unit, $request->quantity[$i] * $prix_unit,$request->tva_apply);
                }
            }
            $mht = ElementProforma::where('id_pro', '=', $dcode_pro_id)->sum('ep_mht');
            $all_qty = ElementProforma::where('id_pro', '=', $dcode_pro_id)->sum('ep_qty');

            $red = $prof->GetReduction($mht, $request->reduction);
            $amountRed = $mht - $red; 
            if($request->tva_apply=="on"){$tva = $prof->GetTVAValue($amountRed);}else{$tva = 0;} 

            $up_pro = $prof->SetPriceProforma($dcode_pro_id,$amountRed, $mht, $tva, $all_qty, $red);

            $historic = new HistoricService();
            $historic->Add('Add new proforma');
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return redirect()->back()->with('success', 'Proforma ajoutée');
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
        $pro = Proformas::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits', 'produits.id', '=', 'element_proformas.id_prod')->where('id_pro', '=', $decoded_id)->get();
        $cl = Cliente::find($pro->id_cli);
        $usr = User::find($pro->id_usr);

        $historic = new HistoricService();
        $historic->Add('Detail proforma ');
        return view('proforma.detailProforma', ['pro' => $pro, 'eps' => $eps, 'cl' => $cl, 'ent' => $ent, 'usr' => $usr]);
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
        $pro = Proformas::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits', 'produits.id', '=', 'element_proformas.id_prod')
        ->where('id_pro', '=', $decoded_id)->get();
        $cl = Cliente::find($pro->id_cli);
        $usr = User::find($pro->id_usr);
        $clients = Cliente::where('clientes.id_ent', '=', Auth::user()->id_ent)->get();
        $produits = Produit::where('produits.id_ent', '=', Auth::user()->id_ent)->get();
        //dd($produits);
        $historic = new HistoricService();
        $historic->Add('Edit proforma');
        return view('proforma.editProforma', ['pro' => $pro, 'eps' => $eps, 'cl' => $cl, 
        'ent' => $ent, 'usr' => $usr, 'clients' => $clients, 'produits' => $produits]);
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
    
    public function generatePDF($id)
    {

        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $pro = Proformas::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits', 'produits.id', '=', 'element_proformas.id_prod')->where('id_pro', '=', $decoded_id)->get();
        $cl = Cliente::find($pro->id_cli);
        $usr = User::find(Auth::user()->id);

        $pdf = Pdf::loadView('print.propdf', [
            'pro' => $pro,
            'ent' => $ent,
            'eps' => $eps,
            'cl' => $cl,
            'usr' => $usr,
        ])->setPaper('a4')->setOption(['dpi' => 150, 'isRemoteEnabled' => true, 'defaultFont' => 'Ayuthaya', 'isPhpEnabled' => true]);
        $historic = new HistoricService();
        $historic->Add('Print proformas');
        $pdf->download('PRO_'.$pro->pro_ref);
        return redirect()->back()->with('success', 'Proforma generée');
    }

    public function validPro($id){
        try { 
            DB::beginTransaction();
            //decode receive is form http
            $decode = new DecodeService();
            $decoded_id = $decode->DecodeId($id);
            //find proforma and test status
            $pro = Proformas::find($decoded_id);
            if($pro->stat_pro=="VALIDATED"){ return redirect()->back()->with('success', 'Proforma deja validée');}

            //validate proforma
            $proSvc = new ProformaService();
            $mypro = $proSvc->ValidateProforma($decoded_id);
            DB::commit();

        }catch(\Exception $e) {
        
            DB::rollback();
            throw $e;
        }
        return redirect()->back()->with('success', 'Proforma validée');
    }
}
