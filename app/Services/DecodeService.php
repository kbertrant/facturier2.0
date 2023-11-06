<?php 

namespace App\Services;

use Vinkla\Hashids\Facades\Hashids;

class DecodeService
{
    public function DecodeId($id){
        $dcodeid = Hashids::decode($id);
        return $dcodeid[0];
    }
}