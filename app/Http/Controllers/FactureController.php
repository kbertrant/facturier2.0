<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\Entreprise;
use App\Models\Facture;
use App\Models\Produit;
use App\Services\EltFactureService;
use App\Services\FactureService;
use App\Services\ProduitService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Vinkla\Hashids\Facades\Hashids;

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

            $tasks = Facture::select('factures.id','ref_fac','date_fac','amount_fac','qty_fac','tva_price','stat_fac',
            'name_cli')
            ->join('clientes','clientes.id','=','factures.id_cli')
            ->where('factures.id_ent','=',Auth::user()->id_ent)->get();
            
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
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/facture/edit/".$row->id."' ><i class='bx bxs-edit'></i></a>";
                
                return $updateButton." ".$showButton;
                 
         })
         
            ->rawColumns(['stat_fac','action'])
            ->addIndexColumn()
            ->make(true);
        }
        $clients = Cliente::where('clientes.id_ent','=',Auth::user()->id_ent)->get();;
        $produits = Produit::where('produits.id_ent','=',Auth::user()->id_ent)->get();;
        
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
        Validator::make($request->all(),[
            'id_cli' => ['required'],
            'id_prod' => ['required'],
            'quantity' => ['required'],
            'reduction' => ['required']
        ]); 

        $date = now();
        $result = $date->format('YmdHis');
        $fac = new FactureService();
        $new_fac = $fac->CreateFacture($request->id_cli,null,$result,0,0,0,$request->reduction);

        $somme = array();
        $all_qty = array();
        $s = 0;
        foreach ($request->id_prod as $p) {
            $i = $s++;
            if($p!=null){

                $pro = new ProduitService();
                $pro->decrementQteProduct($request->quantity[$i],$p);

                $prix_unit = $pro->getPriceProduct($p);

                $ef = new EltFactureService();
                $ef->CreateEltFacture($p,$new_fac->id,$request->quantity[$i],$prix_unit,$request->quantity[$i]*$prix_unit);
                
                array_push($somme, $prix_unit * $request->quantity[$i]);
                array_push($all_qty,  $request->quantity[$i]);
            }
        }
        //dd($somme[0]);
        $tva = $fac->GetTVAValue($somme[0]);
        $red = $fac->GetReduction($somme[0],$request->reduction);

        $up_fac = $fac->SetPriceFacture($new_fac->id,$somme[0],$all_qty[0],$tva,$red);

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
        $decoded_id = Hashids::decode($id);
        $fac = Facture::find($decoded_id[0]);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$id)->get();
        $cl = Cliente::find($fac->id_cli);

        //dd($ent);
        return view('facture.detailFacture',['fac'=>$fac,'efs'=>$efs,'cl'=>$cl,'ent'=>$ent]);
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

        $fac = Facture::find($id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $efs = ElementFacture::join('produits','produits.id','=','element_factures.id_prod')->where('id_fac','=',$id)->get();
        $cl = Cliente::find($fac->id_cli);

        $pdf = Pdf::loadView('print.facpdf', [
            'fac' => $fac,
            'ent' => $ent,
            'efs' => $efs,
            'cl' => $cl,
        ])->setPaper('a4')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        
        return $pdf->download('FAC_'.$fac->ref_fac.'.pdf');
        
    }
}
