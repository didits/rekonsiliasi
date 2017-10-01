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
use phpDocumentor\Reflection\Types\Null_;

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
//        dd((json_decode($penyulang_array[0]['data'], true)['hasil_pengolahan']['visual']));
        $total_lwbp1 = 0;$total_lwbp2 = 0;$total_wbp = 0;
        $total_lwbp1_ = 0;$total_lwbp2_ = 0;$total_wbp_ = 0;
        $hasil_lwbp1 = null; $hasil_lwbp2=null; $hasil_wbp=null;
        $hasil_lwbp1_=null; $hasil_lwbp2_=null; $hasil_wbp_=null;
        for ($i=0; $i < count($cmb->id); $i++) {
            for ($j = 0; $j < count($penyulang_array); $j++) {
                if ($penyulang_array[$j]['id_trafo'] == $cmb->id[$i]) {
                    if($penyulang_array[$j]['data'] == ""){
                        $hasil_lwbp1 = null; $hasil_lwbp2=null; $hasil_wbp=null;
                    }
                    else{
                        $hasil_lwbp1 = (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['visual']['lwbp1_visual'])
                            + (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['download']['lwbp1_download']);
                        $hasil_lwbp2 = (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['visual']['lwbp2_visual'])
                            + (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['download']['lwbp2_download']);
                        $hasil_wbp = (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['visual']['wbp_visual'])
                            + (json_decode($penyulang_array[$j]['data'], true)['hasil_pengolahan']['download']['wbp_download']);
                        $total_lwbp1 += $hasil_lwbp1;
                        $total_lwbp2 += $hasil_lwbp2;
                        $total_wbp += $hasil_wbp;
                    }
                    if($penyulang_array[$j]['data_']== ""){
                        $hasil_lwbp1_=null; $hasil_lwbp2_=null; $hasil_wbp_=null;
                    }
                    else{
                        $hasil_lwbp1_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp1_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp1_download']);
                        $hasil_lwbp2_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp2_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp2_download']);
                        $hasil_wbp_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['wbp_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['wbp_download']);
                        $total_lwbp1_ += $hasil_lwbp1_;
                        $total_lwbp2_ += $hasil_lwbp2_;
                        $total_wbp_ += $hasil_wbp_;
                    }
                }
            }
            $pemakaian_penyulang = array(
                'pemakaian_lwbp1' => $total_lwbp1,
                'pemakaian_lwbp2' => $total_lwbp2,
                'pemakaian_wbp' => $total_wbp,
                'total_pemakaian_energi' => $total_lwbp1+$total_lwbp2+$total_wbp,
                'pemakaian_lwbp1_' => $total_lwbp1_,
                'pemakaian_lwbp2_' => $total_lwbp2_,
                'pemakaian_wbp_' => $total_wbp_,
                'total_pemakaian_energi_' => $total_lwbp1_+$total_lwbp2_+$total_wbp_
            );
            array_push($list_array,$pemakaian_penyulang);
            $total_lwbp1 = $total_lwbp2 = $total_wbp = null;
            $hasil_lwbp1= $hasil_lwbp2 = $hasil_wbp= null;
            $total_lwbp1_ = $total_lwbp2_ = $total_wbp_ = null;
            $hasil_lwbp1_= $hasil_lwbp2_= $hasil_wbp_= null;
        }
        $sum =0;
        if(count($cmb->p_trafo)>0){
            for ($j=0; $j < count($penyulang_array); $j++)
                if ($penyulang_array[$j]['id_trafo'] == $cmb->p_trafo[0]->id_trafo_gi)
                    $sum += (json_decode($cmb->p_trafo_[0]->data, true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'] - json_decode($cmb->p_trafo_[0]->data, true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])
                        / ($list_array[0]['total_pemakaian_energi_']) * (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
        }

//        dd($list_array);
//        $list_array BUAT Total P.E. per Trafo di GI
//        $penyulang_array Data SEMUA Penyulang di GI
        $no_trafo =0;
        $no_penyulang =1;

        $A_lwbp1 = (json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['utama']['download']['lwbp1_download']-json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual']);
        $A_lwbp2 = (json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['utama']['download']['lwbp2_download']-json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual']);
        $A_wbp   = (json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['utama']['download']['wbp_download']-json_decode($cmb->p_trafo_[$no_trafo]['data'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual']);
        $B = (json_decode($cmb->p_trafo_[$no_trafo]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
             -json_decode($cmb->p_trafo_[$no_trafo]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
        $C = $B/($list_array[$no_trafo]['total_pemakaian_energi_'])*(json_decode($penyulang_array[$no_penyulang]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
        $KWH_salur_lwbp1 = intval((($A_lwbp1/$B*$C/1) + 0.5 )*1);
        $KWH_salur_lwbp2 = intval((($A_lwbp2/$B*$C/1) + 0.5 )*1);
        $KWH_salur_wbp = intval((($A_wbp/$B*$C/1) + 0.5 )*1);

//      INI DITANYAIN BIKIN FORM ATAU TIDAK??? KALO IYA DIMASUKIN ke Penyimpanan Trafo GI
        $daya_konsiden_utama = 17097;
        $daya_konsiden_ps = 18;
        $D = $daya_konsiden_utama -$daya_konsiden_ps;

//        $i = (json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
//            - json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
//        $c = $i / ($list_array[0]['total_pemakaian_energi_'])*(json_decode($penyulang_array[0]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
//        $KW = intval(($c/$B*$D) + 0.5 )* 1;

        $c = 1 / ($list_array[$no_trafo]['total_pemakaian_energi_'])*(json_decode($penyulang_array[$no_penyulang]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
        $KW = intval((($c*$D) + 0.5 )* 1);
        $total_kwh = $KWH_salur_lwbp1+$KWH_salur_lwbp2+$KWH_salur_wbp;

//      YANG DISIMPAN di data_keluar Penyimpanan Penyulang
//      KOLOM F, G, H, I, K
//      $KWH_salur_lwbp1, $KWH_salur_lwbp2, $KWH_salur_wbp, $KW, $total_kwh
        $KWH_bulan_lalu = 2714687;

//      KOLOM N, O
//      $KWH = $total_kwh - $KWH_bulan_lalu;
//      $persen = $KWH/$KWH_bulan_lalu*100;

        $data_keluar = array(
            'lwbp1' => $KWH_salur_lwbp1,
            'lwbp2' => $KWH_salur_lwbp2,
            'wbp'   => $KWH_salur_wbp,
            'total_kwh' => $total_kwh,
            'KW' => $KW
        );
//        dd($data_keluar);

        return view('admin.nonmaster.laporan.gi',[
            'data'      => $cmb,
            'penyulang' => $penyulang_array,
            'pemakaian' => $list_array,
            'sum'       => $sum,
            'gi'        => $gi,
            'area'      => $area->nama_organisasi
        ]);
    }
}
