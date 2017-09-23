<?php

namespace App\Http\Controllers;


use App\Gardu;
use App\GI;
use App\Organisasi;
use App\Penyulang;
use App\TrafoGI;
use App\Transfer;

class Master
{
    public function __construct($id_rayon,$tipe,$id)
    {
        $this->id_rayon = $id_rayon;
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $this->nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $nama="";
        if($tipe=="tgi"){
            $this->data = TrafoGI::where('id_gi', $id)->get();
            $nama = GI::select('nama_gi')->where('id', $id)->first();
        }
        elseif($tipe=="penyulang"){
            $transfer = Transfer::where('id_trafo_gi',$id)->pluck('id_penyulang');
            $data = Penyulang::select('id','nama_penyulang','alamat_penyulang','data_master')
                ->whereNotIn('id',$transfer)
                ->where('id_trafo_gi',$id)
                ->get();
            $this->data =$data;
            $nama = TrafoGI::select('nama_trafo_gi')->where('id', $id)->first();
        }
        elseif($tipe=="gd"){
            $this->data = Gardu::where('id_penyulang', $id)->get();
            $nama = Penyulang::select('nama_penyulang')->where('id', $id)->first();
        }
        $id_ryn = Organisasi::where('id_organisasi', $id_rayon)->first();
        $this->data2 = Transfer::select('transfer.id_organisasi','transfer.id_gi', 'gi.nama_gi', 'gi.alamat_gi')
            ->join('GI','GI.id','=','transfer.id_gi')->distinct('transfer.id_gi')
            ->where('transfer.id_organisasi', $id_ryn->id)->get();
        $this->tipe = $tipe;
        $this->nama = $nama;
    }
}