<?php

namespace App\Http\Controllers;


use App\GI;
use App\Organisasi;
use App\Transfer;

class MasterGI
{
    public function __construct($id_rayon)
    {
        $this->id_rayon = $id_rayon;
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $this->nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $this->data = GI::where('id_organisasi', $id_org)->get();
        $id_ryn = Organisasi::where('id_organisasi', $id_rayon)->first();
        $this->data2 = Transfer::select('transfer.id_organisasi','transfer.id_gi', 'gi.nama_gi', 'gi.alamat_gi')
            ->join('gi','gi.id','=','transfer.id_gi')->distinct('transfer.id_gi')
            ->where('transfer.id_organisasi', $id_ryn->id)->get();
    }

}