<?php

namespace App\Http\Controllers;


use App\Gardu;
use App\GI;
use App\Organisasi;
use App\PenyimpananGardu;
use App\PenyimpananPenyulang;
use App\PenyimpananTrafoGI;
use App\Penyulang;
use App\TrafoGI;
use App\Transfer;

class MasterLaporan
{
    public function __construct($id_rayon,$tipe,$id)
    {
        if(date("m")<3){
            if(date("m")==1){
                $date_prev = (date("Y")-1)."11";
                $date_now =  (date("Y")-1)."12";
            }
            else{
                $date_prev = (date("Y") - 1) . "12";
                $date_now = date("Ym") - 1;}
        }else{
            $date_prev = (date("Ym")-2);
            $date_now = date("Ym")-1;
        }

        $MasterTrafo = TrafoGI::where('id_gi',$id)->get();
        $id_trafo = TrafoGI::where('id_gi',$id)->pluck('id');
        $p_trafo = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',"L".$date_prev)->get();
        if($p_trafo == null) $p_trafo = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',$date_prev)->get();
        $p_trafo_ = PenyimpananTrafoGI::whereIn('id_trafo_gi',$id_trafo)->where('periode',$date_now)->get();

        $MasterPenyulang = Penyulang::whereIn('id_trafo_gi',$id_trafo)->get();
        $id_penyulang = Penyulang::whereIn('id_trafo_gi',$id_trafo)->pluck('id');
        $p_penyulang = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',"L".$date_prev)->get();
        if($p_penyulang == null) $p_penyulang = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',$date_prev)->get();
        $p_penyulang_ = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',$date_now)->get();

        if($tipe == "tsa_area"){
            $this->trafo = $MasterTrafo;
            $this->penyulang = $MasterPenyulang;
            $this->p_trafo = $p_trafo;
            $this->p_penyulang = $p_penyulang;
            $this->p_trafo_ = $p_trafo_;
            $this->p_penyulang_ = $p_penyulang_;
            $this->id = $id_trafo;
        }
        elseif($tipe == "tsa"){
            $this->trafo = $MasterTrafo;
            $this->penyulang = $MasterPenyulang;
            $this->p_trafo = $p_trafo;
            $this->p_penyulang = $p_penyulang;
            $this->p_trafo_ = $p_trafo_;
            $this->p_penyulang_ = $p_penyulang_;
            $this->id = $id_trafo;
        }

        elseif($tipe == "deviasi"){
            $this->trafo = $MasterTrafo;
            $this->id = $id_trafo;
        }
        elseif($tipe == "pct"){
            $gardu = Gardu::where(function ($query) use ($id_rayon) {
                    $query
                        ->whereIn('id_organisasi',$id_rayon)
                        ->OrWhereIn('asal',$id_rayon)
                        ->OrWhereIn('tujuan',$id_rayon)
                    ;
                })->where('tipe_gardu',1)->get()->toArray();

            $id_gardu = array_column($gardu,'id');
            $id_penyulang = array_column($gardu,'id_penyulang');

            $p_gardu = PenyimpananGardu::whereIn('id_gardu',$id_gardu)->where('periode',$date_now)->get()->toArray();
            $p_penyulang = PenyimpananPenyulang::whereIn('id_penyulang',$id_penyulang)->where('periode',$date_now)->get()->toArray();
            $this ->gardu =$gardu;
            $this ->p_gardu=$p_gardu;
            $this ->p_penyulang =$p_penyulang;
        }
    }
}