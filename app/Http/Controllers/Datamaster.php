<?php

namespace App\Http\Controllers;


use App\Gardu;
use App\GI; 
use App\Organisasi;
use App\Penyulang;
use App\TrafoGI;
use App\Transfer;
use Auth;
use Illuminate\Support\Facades\DB;

class Datamaster
{
    public function list_master_rayon()
    {
        return $this->list_rayon(Auth::user()->id_organisasi);
    }

    public function list_master_rayons($id_org)
    {
        return $this->list_rayon($id_org);
    }

    public function list_rayon($id_org)
    {
        $data = Organisasi::where('id_organisasi', 'like', substr($id_org, 0, 3) . '%')
        ->where('tipe_organisasi', '3')
        ->get();
        $list_dist = new AreaController;
        $data_org = Organisasi::select('id', 'id_organisasi', 'nama_organisasi')->where('id_organisasi', Auth::user()->id_organisasi)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster', [
            'data' => $data,
            'data_org' => $data_org,
            'list_distribusi' => $list_dist->list_distribusi(),
            'laporan' => true, 'transaksi' => false]);
    }

    public function list_master_gi($id_rayon)
    {
        $master_gi = new MasterGI($id_rayon);
        return view('admin.nonmaster.dashboard_user.list_datamaster2_', [
            'data' => $master_gi->data,
            'data2' => $master_gi->data2,
            'tipe' => "gi",
            'id_organisasi' => $master_gi->id_rayon,
            'id_org' => $master_gi->id_org,
            'nama_rayon' => $master_gi->nama_rayon,
            'laporan' => true, 'transaksi' => false
        ]);
    }

    public function list_master($id_rayon, $tipe, $id)
    {
        if ($tipe == 'gtt_pct')
            $tipe = 'gd';

        $master = new Master($id_rayon, $tipe, $id);

        if($tipe == 'tgi')
            if ($master->data->count() == 0)
                $master->data = null;
            if ($master->data2->count() == 0)
                $master->data2 = null;
            return view('admin.nonmaster.dashboard_user.list_datamaster2_', [
                'data' => $master->data,
                'data2' => $master->data2,
                'tipe' => $master->tipe,
                'id_organisasi' => $master->id_rayon,
                'nama_rayon' => $master->nama_rayon,
                'nama' => $master->nama,
                'laporan' => true, 'transaksi' => false
            ]);
        }

        public function view_datamaster($id_organisasi, $unit, $id_unit)
        {
            $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();

            if ($unit == "gi") {
                $master = GI::where('id', $id_unit)->first();
                $data = TrafoGI::where('id_gi', $id_unit)->get();
            } elseif ($unit == "tgi") {
                $master = TrafoGI::where('id', $id_unit)->first();
                $data = Penyulang::where('id_trafo_gi', $id_unit)->get();
            } elseif ($unit == "penyulang") {
                $master = Penyulang::where('id', $id_unit)->first();
                $data = Gardu::where('id_penyulang', $id_unit)->get();
            } elseif ($unit == "gd") {
                $master = Gardu::where('id', $id_unit)->first();
                $data = "";
            }

            $decoded = json_decode($master->data_master, true);
            return view("admin.nonmaster.dashboard_user.laporan_datamaster", [
                'unit' => $unit,
                'data' => $data,
                'decoded' => $decoded,
                'master' => $master,
                'id_unit' => $id_unit,
                'rayon' => $rayon,
                'id_org' => $id_organisasi
            ]);
        }

        public function getStructureKelistrikan($id_organisasi)
        {
            $tanggal_sekarang = date("Y-m");
            $dt=date_create($tanggal_sekarang." first day of last month");
            $tanggal = $dt->format('Ym');
            if(strlen($id_organisasi)==5){
                $nama_rayon = Organisasi::where("id_organisasi",$id_organisasi)->first();
                $id_organisasi =$nama_rayon->id;
            }
            else $nama_rayon = Organisasi::find($id_organisasi);
                $area = array('name' => $nama_rayon->nama_organisasi, 'title' => '', 'children' => '', 'office' => 'Rayon ', 'className' => 'middle-level');
                for ($h = 0; $h < 1; $h++) {
                    $gi = DB::select(DB::raw("select nama_gi as name, alamat_gi as title, gi.id as id, periode as periode from gi, penyimpanan_gi where gi.id = penyimpanan_gi.id_gi and id_organisasi = ".$id_organisasi." and penyimpanan_gi.id in (select max(penyimpanan_gi.id) from penyimpanan_gi group by penyimpanan_gi.id_gi)"));
                    $gi_array = array();
                    for ($i = 0; $i < count($gi); $i++) {
                        $trafo_gi = DB::select(DB::raw("select nama_trafo_gi as name, alamat_trafo_gi as title, trafo_gi.id as id, periode as periode from trafo_gi, penyimpanan_trafo_gi where trafo_gi.id = penyimpanan_trafo_gi.id_trafo_gi and id_organisasi = ".$id_organisasi." and trafo_gi.id_gi = ".$gi[$i]->id." and penyimpanan_trafo_gi.id in (select max(penyimpanan_trafo_gi.id) from penyimpanan_trafo_gi group by penyimpanan_trafo_gi.id_trafo_gi)"));
                        $trafo_gi_array = array();
                        for ($j = 0; $j < count($trafo_gi); $j++) {
                            $penyulang = DB::select(DB::raw("select nama_penyulang as name, alamat_penyulang as title, penyulang.id as id, periode as periode, penyulang.id_organisasi as id_org from penyulang, penyimpanan_penyulang where penyulang.id = penyimpanan_penyulang.id_penyulang and id_organisasi = ".$id_organisasi." and penyulang.id_trafo_gi = ".$trafo_gi[$j]->id." and penyimpanan_penyulang.id in (select max(penyimpanan_penyulang.id) from penyimpanan_penyulang group by penyimpanan_penyulang.id_penyulang)"));

                            $penyulang_array = array();
                            for ($k = 0; $k < count($penyulang); $k++) {
                                $penyulang_rayon = Transfer::where('id_penyulang', $penyulang[$k]->id)->first();
                                if($penyulang_rayon)
                                    $org = Organisasi::where('id',$penyulang_rayon->id_organisasi)->first();
                                else
                                    $org = Organisasi::where('id',$penyulang[$k]->id_org)->first();
                                $penyulang[$k]->title= "RAYON ".$org['nama_organisasi'];

                                $gardu = DB::select(DB::raw("select nama_gardu as name, alamat_gardu as title, gardu.id as id, periode as periode, gardu.tipe_gardu as tipe_gardu, gardu.rincian as rincian from gardu, penyimpanan_gardu where gardu.id = penyimpanan_gardu.id_gardu and gardu.id_penyulang = ".$penyulang[$k]->id." and penyimpanan_gardu.id in (select max(penyimpanan_gardu.id) from penyimpanan_gardu group by penyimpanan_gardu.id_gardu)"));
                                $semua_gardu = array();
                                $gardu_array = array();
                                for ($l = 0; $l < count($gardu); $l++) {
                                    if ($gardu[$l] && $gardu[$l]->tipe_gardu == 0)
                                        if($gardu[$l]->periode == $tanggal)
                                            array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' => $gardu[$l]->title, 'office' => '', 'className' => 'product-dept'));
                                        else
                                            array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' => $gardu[$l]->title, 'office' => ''));
                                    }

                                    $gardu_array = array();

                                    for ($l = 0; $l < count($gardu); $l++) {
                                        if ($gardu[$l] && $gardu[$l]->tipe_gardu == 1)
                                            if($gardu[$l]->periode == $tanggal)
                                                array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' =>  json_decode($gardu[$l]->rincian, true)['antar_unit'], 'office' => 'PCT', 'className' => 'product-dept'));
                                            else
                                                array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' =>  json_decode($gardu[$l]->rincian, true)['antar_unit'], 'office' => 'PCT'));
                                    }

                                    $gardu_array = array();
                                    for ($l = 0; $l < count($gardu); $l++) {
                                        if ($gardu[$l] && $gardu[$l]->tipe_gardu == 2)
                                            if($gardu[$l]->periode == $tanggal)
                                                array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' => $gardu[$l]->title, 'office' => 'TM', 'className' => 'product-dept'));
                                            else
                                                array_push($semua_gardu, array('name' => $gardu[$l]->name, 'title' => $gardu[$l]->title, 'office' => 'TM'));

                                    }

                                    if($penyulang[$k]->periode == $tanggal)
                                        $penyulang_array_ = array('name' => $penyulang[$k]->name, 'title' => $penyulang[$k]->title, 'children' => $semua_gardu, 'office' => 'Penyulang','className' => 'product-dept');
                                    else
                                        $penyulang_array_ = array('name' => $penyulang[$k]->name, 'title' => $penyulang[$k]->title, 'children' => $semua_gardu, 'office' => 'Penyulang');

                                    if ($penyulang_array_)
                                        array_push($penyulang_array, $penyulang_array_);
                                }


                                if ($penyulang_array)
                                    if($trafo_gi[$j]->periode == $tanggal)
                                        $trafo_gi_array_ = array('name' => $trafo_gi[$j]->name, 'title' => $trafo_gi[$j]->title, 'children' => $penyulang_array, 'office' => 'Trafo GI', 'className' => 'product-dept');
                                    else
                                        $trafo_gi_array_ = array('name' => $trafo_gi[$j]->name, 'title' => $trafo_gi[$j]->title, 'children' => $penyulang_array, 'office' => 'Trafo GI');
                                    else
                                        if($trafo_gi[$j]->periode == $tanggal)
                                            $trafo_gi_array_ = array('name' => $trafo_gi[$j]->name, 'title' => $trafo_gi[$j]->title, 'office' => 'Trafo GI', 'className' => 'product-dept');
                                        else
                                            $trafo_gi_array_ = array('name' => $trafo_gi[$j]->name, 'title' => $trafo_gi[$j]->title, 'office' => 'Trafo GI');

                                        array_push($trafo_gi_array, $trafo_gi_array_);
                                    }

                                    if ($trafo_gi_array){
                                        if($gi[$i]->periode == $tanggal)
                                            $gi_array_ = array('name' => $gi[$i]->name, 'title' => $gi[$i]->title, 'children' => $trafo_gi_array, 'office' => 'GI', 'className' => 'product-dept');
                                        else
                                            $gi_array_ = array('name' => $gi[$i]->name, 'title' => $gi[$i]->title, 'children' => $trafo_gi_array, 'office' => 'GI');

                                    }
                                    else{
                                        if($gi[$i]->periode == $tanggal)
                                            $gi_array_ = array('name' => $gi[$i]->name, 'title' => $gi[$i]->title, 'office' => 'GI', 'className' => 'product-dept');
                                        else
                                            $gi_array_ = array('name' => $gi[$i]->name, 'title' => $gi[$i]->title, 'office' => 'GI');
                                    }
                                    array_push($gi_array, $gi_array_);
                                }
                                $area['children'] = $gi_array;
                            }

                            return view('admin.nonmaster.dashboard_user.structure_organization', [
                                'data' => json_encode($area)]);
                        }

                        public function getStructureKelistrikanb($id_organisasi)
                        {
                            if(strlen($id_organisasi)==5){
                                $nama_rayon = Organisasi::where("id_organisasi",$id_organisasi)->first();
                                $id_organisasi =$nama_rayon->id;
                            }
                            else $nama_rayon = Organisasi::find($id_organisasi);
                                $area = array('name' => $nama_rayon->nama_organisasi, 'title' => '', 'children' => '', 'office' => 'Rayon ');
                                for ($h = 0; $h < 1; $h++) {
                                    $gi = GI::where('id_organisasi', $id_organisasi)->get(array('nama_gi as name', 'alamat_gi as title', 'id as id'))->toArray();
                                    $gi_array = array();
                                    for ($i = 0; $i < count($gi); $i++) {
                                        $trafo_gi = TrafoGI::where('id_organisasi', $id_organisasi)->where('id_gi', $gi[$i]['id'])->get(array('nama_trafo_gi as name', 'alamat_trafo_gi as title', 'id as id'))->toArray();
                                        $trafo_gi_array = array();
                                        for ($j = 0; $j < count($trafo_gi); $j++) {
                                            $penyulang = Penyulang::where('id_organisasi', $id_organisasi)->where('id_trafo_gi', $trafo_gi[$j]['id'])->get(array('nama_penyulang as name', 'alamat_penyulang as title', 'id as id', 'id_organisasi as id_org'))->toArray();
                                            $penyulang_array = array();
                                            for ($k = 0; $k < count($penyulang); $k++) {
                                                $penyulang_rayon = Transfer::where('id_penyulang', $penyulang[$k]['id'])->first();
                                                if($penyulang_rayon)
                                                    $org = Organisasi::where('id',$penyulang_rayon->id_organisasi)->first();
                                                else
                                                    $org = Organisasi::where('id',$penyulang[$k]['id_org'])->first();
                                                $penyulang[$k]['title']= "RAYON ".$org['nama_organisasi'];
                                                $gardu = Gardu::where('id_organisasi', $id_organisasi)->where('id_penyulang', $penyulang[$k]['id'])->get(array('nama_gardu as name', 'alamat_gardu as title', 'rincian as rincian', 'tipe_gardu as tipe_gardu'))->toArray();
                                                $semua_gardu = array();
                                                $gardu_array = array();
                                                for ($l = 0; $l < count($gardu); $l++) {
                                                    if ($gardu[$l] && $gardu[$l]['tipe_gardu'] == 0)
                                                        array_push($gardu_array, array('name' => $gardu[$l]['name'], 'title' => $gardu[$l]['title'], 'office' => ''));
                                                }
                                                $penyulang_array_gd = array('name' => 'GD', 'title' => 'GD', 'children' => $gardu_array, 'office' => 'GD');
                                                if ($gardu_array)
                                                    array_push($semua_gardu, $penyulang_array_gd);

                                                $gardu_array = array();
                                                for ($l = 0; $l < count($gardu); $l++) {
                                                    if ($gardu[$l] && $gardu[$l]['tipe_gardu'] == 1)
                                                        array_push($gardu_array, array('name' => $gardu[$l]['name'], 'title' => json_decode($gardu[$l]['rincian'], true)['antar_unit'], 'office' => ''));
                                                }
                                                $penyulang_array_pct = array('name' => 'PCT', 'title' => 'PCT', 'children' => $gardu_array, 'office' => 'PCT');
                                                if ($gardu_array)
                                                    array_push($semua_gardu, $penyulang_array_pct);

                                                $gardu_array = array();
                                                for ($l = 0; $l < count($gardu); $l++) {
                                                    if ($gardu[$l] && $gardu[$l]['tipe_gardu'] == 2)
                                                        array_push($gardu_array, array('name' => $gardu[$l]['name'], 'title' => $gardu[$l]['title'], 'office' => ''));

                                                }
                                                $penyulang_array_tm = array('name' => 'TM', 'title' => 'TM', 'children' => $gardu_array, 'office' => 'TM');
                                                if ($gardu_array)
                                                    array_push($semua_gardu, $penyulang_array_tm);


                                                $penyulang_array_ = array('name' => $penyulang[$k]['name'], 'title' => $penyulang[$k]['title'], 'children' => $semua_gardu, 'office' => 'Penyulang');
                                                if ($penyulang_array_)
                                                    array_push($penyulang_array, $penyulang_array_);
                                            }


                                            if ($penyulang_array)
                                                $trafo_gi_array_ = array('name' => $trafo_gi[$j]['name'], 'title' => $trafo_gi[$j]['title'], 'children' => $penyulang_array, 'office' => 'Trafo GI');
                                            else
                                                $trafo_gi_array_ = array('name' => $trafo_gi[$j]['name'], 'title' => $trafo_gi[$j]['title'], 'office' => 'Trafo GI');
                                            array_push($trafo_gi_array, $trafo_gi_array_);
                                        }

                                        if ($trafo_gi_array)
                                            $gi_array_ = array('name' => $gi[$i]['name'], 'title' => $gi[$i]['title'], 'children' => $trafo_gi_array, 'office' => 'GI');
                                        else
                                            $gi_array_ = array('name' => $gi[$i]['name'], 'title' => $gi[$i]['title'], 'office' => 'GI');
                                        array_push($gi_array, $gi_array_);
                                    }
                                    $area['children'] = $gi_array;
                                }

                                return view('admin.nonmaster.dashboard_user.structure_organization', [
                                    'data' => json_encode($area)]);
                            }
                        }