<?php

namespace App\Http\Controllers;

use App\Organisasi;

class AjaxController extends Controller
{
    public function populateRayon($id_area)
    {
        $subarea    = substr($id_area, 0, 3) . "%%";
        $rayon = Organisasi::select('id_organisasi', 'nama_organisasi')->where([
            ['id_organisasi', 'like', $subarea],
            ['tipe_organisasi', '!=', 2]])->pluck('nama_organisasi', 'id_organisasi');
        return json_encode($rayon);
    }
}
