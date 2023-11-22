<?php

namespace App\Http\Controllers;

use App\Models\TypeCliente;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TypeClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = TypeCliente::all();
            
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/type/client/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/type/client/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$deleteButton." ".$showButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List type client');

        return view('client.listTypeClient');
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
        Validator::make($request->all(),[
            'name_tc' => ['required'],
        ]); 
        
        $cli = new TypeCliente();
        $cli->name_tc = $request->name_tc;
        $cli->status = "A";
        $cli->save();

        $historic = new HistoricService();
        $historic->Add('Add new type client');

        return redirect()->back()->with('success','Type Client ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function show(TypeCliente $typeClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function edit(TypeCliente $typeClient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TypeCliente $typeClient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tc = TypeCliente::find($id);
        $tc->delete();
        return redirect()->back()->with('success','type client supprimé');
    }
}
