<?php

namespace App\Http\Controllers;


use App\Gardu;
use App\GI;
use App\Organisasi;
use App\PenyimpananPenyulang;
use App\PenyimpananTrafoGI;
use App\Penyulang;
use App\TrafoGI;
use App\Transfer;

class MasterLaporan
{
    public function __construct($id_rayon,$tipe,$id)
    {
        $date = date("Ym")-1;
        $MasterTrafo = TrafoGI::where('id_gi',$id)->get();
        $id_trafo = TrafoGI::where('id_gi',$id)->pluck('id');
        $p_trafo = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',"L".$date)->get();
        if($p_trafo == null) $p_trafo = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',$date)->get();
        $p_trafo_ = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',date("Ym"))->get();

        $MasterPenyulang = Penyulang::whereIn('id_trafo_gi',$id_trafo)->get();
        $id_penyulang = Penyulang::whereIn('id_trafo_gi',$id_trafo)->pluck('id');
        $p_penyulang = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',"L".$date)->get();
        if($p_penyulang == null) $p_penyulang = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',$date)->get();
        $p_penyulang_ = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',date("Ym"))->get();

        if($tipe = "tsa"){
            $this->trafo = $MasterTrafo;
            $this->penyulang = $MasterPenyulang;
            $this->p_trafo = $p_trafo;
            $this->p_penyulang = $p_penyulang;
            $this->p_trafo_ = $p_trafo_;
            $this->p_penyulang_ = $p_penyulang_;
            $this->id = $id_trafo;
        }
        elseif($tipe = "deviasi"){
            $this->trafo = $MasterTrafo;
            $this->id = $id_trafo;
        }
    }
}