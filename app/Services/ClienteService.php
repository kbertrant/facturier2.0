<?php 

namespace App\Services;

use App\Models\Cliente;
use App\Models\Facture;
use Illuminate\Support\Facades\Auth;

class ClienteService
{
    public function CreateCliente($name_cli,$phone_cli,$address_cli,$raison_sociale,$cl_rccm,$cl_nui,$cl_email,$id_tc){

        $catpro = new Cliente();
        $catpro->name_cli = $name_cli;
        $catpro->phone_cli = $phone_cli;
        $catpro->address_cli = $address_cli;
        $catpro->raison_sociale = $raison_sociale;
        $catpro->cl_rccm = $cl_rccm;
        $catpro->cl_nui = $cl_nui;
        $catpro->cl_email = $cl_email;
        $catpro->id_tc = $id_tc;
        $catpro->status = 'A';
        $catpro->id_ent = Auth::user()->id_ent;
        $catpro->save();

        return $catpro;

    }

    public function ListFacturesClient($id_cl){

        return $fac = Facture::where('id_cli','=',$id_cl)->get();
    }
}