<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ElementFacture;
use App\Models\ElementProforma;
use App\Models\Entreprise;
use App\Models\Produit;
use App\Models\Proformas;
use App\Services\EltProformaService;
use App\Services\ProduitService;
use App\Services\ProformaService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

            $tasks = Proformas::select('proformas.id','pro_ref','date_pro','amount_pro','qty_pro','tva_price','stat_pro',
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
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' href='/proforma/show/".$row->id."'><i data-lucide='plus' class='w-5 h-5'>Details</i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/proforma/edit/".$row->id."' ><i data-lucide='trash' class='w-5 h-5'>Modif</i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/proforma/destroy/".$row->id."'><i data-lucide='trash' class='w-5 h-5'>Suppr</i></a>";

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

        $date = now();
        $result = $date->format('YmdHis');
        $prof = new ProformaService();
        $new_prof = $prof->CreateProforma($request->id_cli,$result,0,0,0,$request->reduction);

        $somme = array();
        $all_qty = array();
        $s = 0;
        foreach ($request->id_prod as $p) {
            $i = $s++;
            if($p!=null){

                $pro = new ProduitService();
                $pro->decrementQteProduct($request->quantity[$i],$p);

                $prix_unit = $pro->getPriceProduct($p);

                $ep = new EltProformaService();
                $ep->CreateEltProforma($p,$new_prof->id,$request->quantity[$i],$prix_unit,$request->quantity[$i]*$prix_unit);
                
                array_push($somme, $prix_unit * $request->quantity[$i]);
                array_push($all_qty,  $request->quantity[$i]);
            }
        }
        //dd($somme[0]);
        $tva = $prof->GetTVAValue($somme[0]);
        $red = $prof->GetReduction($somme[0],$request->reduction);

        $up_pro = $prof->SetPriceProforma($new_prof->id,$somme[0],$all_qty[0],$tva,$red);

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
        $pro = Proformas::find($id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits','produits.id','=','element_proformas.id_prod')->where('id_pro','=',$id)->get();
        $cl = Cliente::find($pro->id_cli);

        //dd($ent);
        return view('proforma.detailProforma',['pro'=>$pro,'eps'=>$eps,'cl'=>$cl,'ent'=>$ent]);
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

        $pro = Proformas::find($id);
        $ent = Entreprise::find(Auth::user()->id_ent);
        $eps = ElementProforma::join('produits','produits.id','=','element_proformas.id_prod')->where('id_pro','=',$id)->get();
        $cl = Cliente::find($pro->id_cli);

        $pdf = Pdf::loadView('print.propdf', [
            'pro' => $pro,
            'ent' => $ent,
            'eps' => $eps,
            'cl' => $cl,
        ])->setPaper('a4')->setOption(['dpi' => 150,'isRemoteEnabled' => true,'defaultFont' => 'Ayuthaya','isPhpEnabled' => true]);
        
        return $pdf->download('PRO_'.$pro->pro_ref.'.pdf');
        
    }
}
