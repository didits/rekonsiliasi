<?php

namespace App\Http\Controllers;

use App\GI;
use App\Organisasi;
use App\PenyimpananPenyulang;
use App\PenyimpananTrafoGI;
use App\TrafoGI;
use Illuminate\Http\Request;
use App\Penyulang;
use App\Gardu;
use Illuminate\Support\Facades\Auth;

class Laporan extends Controller
{
    public function list_hasil_laporan_semua_penyulang($id_gardu){
    	$penyulang = Penyulang::where('id_gardu', $id_gardu)
    	->join('penyimpanan_penyulang', 'penyulang.id', '=', 'penyimpanan_penyulang.id_penyulang')->get();
    	//dd($penyulang);

    	$data_hasil_pengolahan_penyulang = array();
    	foreach ($penyulang as $key => $value) {
    		$temp_data = json_decode($value->data, true);
    		$hasil_pengolahan = $temp_data['hasil pengolahan'];
    		$penyulang = array(
    			'nama_penyulang' => $value->nama_penyulang,
    			'data_hasil' =>$hasil_pengolahan
    			);
    		array_push($data_hasil_pengolahan_penyulang, $penyulang);
    	}

    	dd($data_hasil_pengolahan_penyulang);

    	$total_penyulang_visual = array(
            'lwbp1_visual' => $request->lwbp1_visual,
            'lwbp2_visual' => $request->lwbp2_visual,
            'wbp_visual' => $request->wbp_visual,
            'kvarh_visual' => $request->kvarh_visual
        );

        $total_penyulang_download = array(
            'lwbp1_download' => $request->lwbp1_download,
            'lwbp2_download' => $request->lwbp2_download,
            'wbp_download' => $request->wbp_download,
            'kvarh_download' => $request->kvarh_download
        );

    	$data = 0;
    	return view('admin.nonmaster.laporan.semua_penyulang',[
            'data' =>$data
        ]);
    }

    public function list_beli_gi($id_rayon){
        $master_gi = new MasterGI($id_rayon);
        Auth::user()->tipe_organisasi == 3 ? $rayon = true : $rayon = false;
        return view('admin.nonmaster.dashboard_user.list_datamaster2_',[
            'data' =>$master_gi->data,
            'data2' =>$master_gi->data2,
            'tipe' => "gi",
            'id_organisasi'=>$master_gi->id_rayon,
            'nama_rayon' =>$master_gi->nama_rayon,
            'laporan' => false, 'transaksi' => true, 'rayon' => $rayon
        ]);
    }

    public function list_beli($id_rayon,$tipe,$id){
        $master = new Master($id_rayon,$tipe,$id);
        Auth::user()->tipe_organisasi == 3 ? $rayon = true : $rayon = false;
        if($master->data->count()==0)
            $master->data=null;
        if($master->data2->count()==0)
            $master->data2=null;
        return view('admin.nonmaster.dashboard_user.list_datamaster2_',[
            'data' =>$master->data,
            'data2' =>$master->data2,
            'tipe' => $master->tipe,
            'id_organisasi'=>$master->id_rayon,
            'nama_rayon' =>$master->nama_rayon,
            'nama' =>$master->nama,
            'laporan' => false, 'transaksi' => true, 'rayon' => $rayon
        ]);
    }

    public function view_beli($id_rayon,$tipe,$id){
        $cmb = new MasterLaporan($id_rayon,$tipe,$id);
        $gi = GI::where('id',$id)->first();
        $areas = Organisasi::where('id',$gi->id_organisasi)->first();
        $id_org = substr($areas->id_organisasi, 0, 3) . "%%";
        $area = Organisasi::where('id_organisasi', 'like', $id_org)->where('tipe_organisasi', 2)->first();
        $penyulang_array = array();
        $list_array = array();
        $p = $cmb->penyulang->toArray();
        $pp =$cmb->p_penyulang_->toArray();
        $t = $cmb->trafo->toArray();
//        dd($p[0]['id_trafo_gi']);
//        dd($pp[0]['id']);
        for ($j=0; $j < count($p); $j++) {
            $penyulang = PenyimpananPenyulang::where('id_penyulang', $p[$j]['id'])->where('periode', date("Ym")-1)->get(array('data'))->toArray();
            $penyulang_ = PenyimpananPenyulang::where('id_penyulang', $p[$j]['id'])->where('periode', date("Ym"))->get(array('data'))->toArray();
            if(count($penyulang) >0)
                $dt = $penyulang[0]['data'];
            else $dt = "";
            if(count($penyulang_) >0)
                $dt_ = $penyulang_[0]['data'];
            else $dt_ = "";

            $dtpenyulang = array(
                'nama' => $p[$j]['nama_penyulang'],
                'data' => $dt,
                'data_' => $dt_,
                'id_penyulang' => $p[$j]['id'],
                'id_trafo' => $p[$j]['id_trafo_gi'],
            );
            array_push($penyulang_array,$dtpenyulang);
        }

        $total_lwbp1 = 0;$total_lwbp2 = 0;$total_wbp = 0;
        for ($i=0; $i < count($cmb->id); $i++) {
            for ($j = 0; $j < count($penyulang_array); $j++) {
                if ($penyulang_array[$j]['id_trafo'] == $cmb->id[$i]) {
                    $hasil_lwbp1 = abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp1_visual'])
                        + abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp1_download']);
                    $hasil_lwbp2 = abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp2_visual'])
                        + abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp2_download']);
                    $hasil_wbp = abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['wbp_visual'])
                        + abs(json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['wbp_download']);
                    $total_lwbp1 += $hasil_lwbp1;
                    $total_lwbp2 += $hasil_lwbp2;
                    $total_wbp += $hasil_wbp;
                }
            }
            $pemakaian_penyulang = array(
                'pemakaian_lwbp1' => $total_lwbp1,
                'pemakaian_lwbp2' => $total_lwbp2,
                'pemakaian_wbp' => $total_wbp,
                'total_pemakaian_energi' => $total_lwbp2+$total_lwbp1+$total_wbp
            );
            array_push($list_array,$pemakaian_penyulang);
            $total_lwbp1 = 0;$total_lwbp2 = 0;$total_wbp = 0;
        }
//        $list_pemakaian =json_encode($list_array);

// /        for ($j=0; $j < count($cmb->id); $j++) {
//            for ($i=0; $i < count($p); $i++) {
//                if($p[$i]['id_trafo_gi']== $t[$j]['id']){
//                    for ($k=0; $k < count($pp); $k++) {
//                        if($p[$i]['id_trafo_gi']== $pp[$k]['id']){
//                            $t_lwbp1 = $pp[$j]
//                        }
//                    }
//                }
//                //                $lwbp1 =;
////                $lwbp2 =;
////                $wbp =;
//            }
//        }
//        dd($cmb->id);




//        dd(($penyulang_array));
//        dd(($list_array));
        return view('admin.nonmaster.laporan.gi',[
            'data'      => $cmb,
            'penyulang' => $penyulang_array,
            'pemakaian' => $list_array,
//            'pemakaian' => $list_pemakaian,
            'gi'        => $gi,
            'area'      => $area->nama_organisasi
        ]);
    }
}
