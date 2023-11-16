<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\ElementProforma;
use App\Models\Entreprise;
use App\Models\Produit;
use App\Models\Proformas;
use App\Models\User;
use App\Services\DecodeService;
use App\Services\EltProformaService;
use App\Services\ProduitService;
use App\Services\ProformaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

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
        if(request()->ajax()) {

            $tasks = Proformas::select('proformas.id','pro_ref','date_pro','mttc_pro','qty_pro','stat_pro',
            'name_cli')
            ->join('clientes','clientes.id','=','proformas.id_cli')
            ->where('proformas.id_ent','=',Auth::user()->id_ent)->get();
            
            return datatables()->of($tasks)
            ->addColumn('stat_pro', function ($row) {
                if($row->stat_pro == "Pending"){
                $span = "<span class='badge bg-label-danger'>".$row->stat_pro."</span>";
                }else{$span = "<span class='badge bg-label-success'>".$row->stat_pro."</span>";}
                return  $span;})
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/proforma/show/".$row->id."'><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/proforma/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/proforma/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['stat_pro','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $clients = Cliente::where('clientes.id_ent','=',Auth::user()->id_ent)->get();;
        $produits = Produit::where('produits.id_ent','=',Auth::user()->id_ent)->get();;
        
        return view('proforma.listProforma',['clients'=>$clients,'produits'=>$produits]);
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
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'reduction' => ['required']
        ]); 

        $decode = new DecodeService();

        $date = now();
        $result = $date->format('YmdHis');
        $cli = Cliente::where('name_cli','like',$request->id_cli)->first();
        $dcod_cli_id = $decode->DecodeId($cli->id);
        $prof = new ProformaService();
        $new_prof = $prof->CreateProforma($dcod_cli_id,$result,0,0,0,0,$request->reduction);
        $dcode_pro_id = $decode->DecodeId($new_prof->id);
        $s = 0;
        foreach ($request->id_prod as $pr) {
            $p = $decode->DecodeId($pr);
            $i = $s++;
            if($p!=null){

                $pro = new ProduitService();
                $pro->decrementQteProduct($request->quantity[$i],$p);

                $prix_unit = $pro->getPriceProduct($p);

                $ep = new EltProformaService();
                $ep->CreateEltProforma($p,$dcode_pro_id,$request->quantity[$i],$prix_unit,$request->quantity[$i]*$prix_unit);
                
            }
        }
        $somme = ElementProforma::where('id_pro','=',$dcode_pro_id)->sum('ep_ttc');
        $all_qty = ElementProforma::where('id_pro','=',$dcode_pro_id)->sum('ep_qty');

        $tva = $prof->GetTVAValue($somme);
        $mht = $somme - $tva;
        $red = $prof->GetReduction($somme,$request->reduction);

        $up_pro = $prof->SetPriceProforma($dcode_pro_id,$somme,$mht,$tva,$all_qty,$red);

        return redirect()->back()->with('success','Proforma ajoutée');
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
        $eps = ElementProforma::join('produits','produits.id','=','element_proformas.id_prod')->where('id_pro','=',$decoded_id)->get();
        $cl = Cliente::find($pro->id_cli);
        $usr = User::find($pro->id_usr);

        //dd($ent);
        return view('proforma.detailProforma',['pro'=>$pro,'eps'=>$eps,'cl'=>$cl,'ent'=>$ent,'usr'=>$usr]);
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
        $pro = Proformas::find($decoded_id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits','produits.id','=','element_proformas.id_prod')->where('id_pro','=',$decoded_id)->get();
        $cl = Cliente::find($pro->id_cli);
        $usr = User::find(Auth::user()->id);

        $pdf = Pdf::loadView('print.propdf', [
            'pro' => $pro,
            'ent' => $ent,
            'eps' => $eps,
            'cl' => $cl,
            'usr' => $usr,
        ])->setPaper('a6')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        
        return $pdf->download('PRO_'.$pro->pro_ref.'.pdf');
        
    }
}
