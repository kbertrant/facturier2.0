<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\DecodeService;
use App\Services\HistoricService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $tasks = Setting::where('id_ent', '=', Auth::user()->id_ent)->get();
            return datatables()->of($tasks)
            ->addColumn('action', function($row){
   
                // Update Button
                $showButton = "<a class='btn btn-sm btn-warning mr-1 mb-2 viewdetails' data-id='".$row->id."' data-bs-toggle='modal'><i class='bx bxs-detail'></i></a>";
                // Update Button
                $updateButton = "<a class='btn btn-sm btn-info mr-1 mb-2' href='/setting/edit/".$row->id."' data-bs-toggle='modal' data-bs-target='#updateModal' ><i class='bx bxs-edit'></i></a>";
                // Delete Button
                $deleteButton = "<a class='btn btn-sm btn-danger mr-1 mb-2' href='/setting/destroy/".$row->id."'><i class='bx bxs-trash'></i></a>";

                return $updateButton." ".$showButton." ".$deleteButton;
                 
         })
         
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        $historic = new HistoricService();
        $historic->Add('List des parametres');

        return view('setting.listSetting');
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
        $validator = Validator::make($request->all(),[
            'template_inv' => ['required'],
            'print_format' => ['required'],
        ]); 
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $cli = new Setting();
        $cli->template_inv = $request->template_inv;
        $cli->print_format = $request->print_format;
        $cli->save();

        $historic = new HistoricService();
        $historic->Add('Add new setting');

        return redirect()->back()->with('success','Nouveau parametre ajouté');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $typeClient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //dd($id);
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($id);
        $setting = Setting::find($decoded_id);
        
        return view('setting.updateSetting',['setting'=>$setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $validator = Validator::make($request->all(), [
            'template_inv' => ['required'],
            'print_format' => ['required'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $decode = new DecodeService();
        $decoded_id = $decode->DecodeId($request->id);

        $cl = Setting::find($decoded_id);
        $cl->template_inv = $request->template_inv;
        $cl->print_format = $request->print_format;
        $cl->save();

        $historic = new HistoricService();
        $historic->Add('Update setting');

        return redirect()->route('setting.main')->with('success','Parametre modifié avec succes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypeClient  $typeClient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tc = Setting::find($id);
        $tc->delete();
        return redirect()->back()->with('success','Parametre supprimé');
    }
}
