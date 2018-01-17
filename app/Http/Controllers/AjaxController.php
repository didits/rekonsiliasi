<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\Organisasi;
use App\Penyulang;
use App\Transfer;

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
        $rayon = Organisasi::select('id')
            ->where('id_organisasi', $id_rayon)
            ->first();

        $queryPenyulang = Penyulang::select('id', 'nama_penyulang', 'id_trafo_gi')
                            ->where('id_organisasi', $rayon->id);

        $trafo = $queryPenyulang->select('id_trafo_gi')
                                ->distinct()
                                ->pluck('id_trafo_gi');

        $transfers = Transfer::select('transfer.id_penyulang')
            ->whereIn('transfer.id_trafo_gi', $trafo)
            ->join('penyulang', 'transfer.id_penyulang', '=', 'penyulang.id')
            ->select('penyulang.nama_penyulang', 'penyulang.id')
            ->pluck('penyulang.id');

        $transfer = Transfer::select('transfer.id_penyulang')
            ->where('transfer.id_organisasi', $rayon->id)
            ->join('penyulang', 'transfer.id_penyulang', '=', 'penyulang.id')
            ->select('penyulang.nama_penyulang', 'transfer.id_penyulang');

        $penyulangs = Penyulang::where('id_organisasi', $rayon->id)
            ->whereNotIn('id', $transfers)
            ->union($transfer)
            ->select('nama_penyulang', 'id')
            ->pluck('penyulang.nama_penyulang', 'penyulang.id');

        return json_encode($penyulangs);
    }

    public function populateGD($id_penyulang)
    {
        $gardu = Gardu::select('id', 'nama_gardu')->where([
            ['id_penyulang', '=', $id_penyulang],
            ['tipe_gardu', '=', 0]])->pluck('nama_gardu', 'id');
        return json_encode($gardu);
    }
}
