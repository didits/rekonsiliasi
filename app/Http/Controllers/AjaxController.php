<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\Organisasi;
use App\Penyulang;

class AjaxController extends Controller
{
    public function populateArea()
    {
        $dropdown_area = Organisasi::select('id_organisasi', 'nama_organisasi')->where('tipe_organisasi', '=', 2)->get();
        return $dropdown_area;
    }

    public function populateRayon($id_area)
    {
        $subarea    = substr($id_area, 0, 3) . "%%";
        $rayon = Organisasi::select('id_organisasi', 'nama_organisasi')->where([
            ['id_organisasi', 'like', $subarea],
            ['tipe_organisasi', '!=', 2]])->pluck('nama_organisasi', 'id_organisasi');
        return json_encode($rayon);
    }

    public function populatePenyulang($id_rayon)
    {
        $rayon = Organisasi::select('id')->where('id_organisasi', $id_rayon)->first();
        $penyulang = Penyulang::select('id', 'nama_penyulang')->where('id_organisasi', $rayon->id)->pluck('nama_penyulang', 'id');
        return json_encode($penyulang);
    }

    public function populateGD($id_penyulang)
    {
        $gardu = Gardu::select('id', 'nama_gardu')->where([
            ['id_penyulang', '=', $id_penyulang],
            ['tipe_gardu', '=', 0]])->pluck('nama_gardu', 'id');
        return json_encode($gardu);
    }
}
