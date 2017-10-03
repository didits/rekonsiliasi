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
//        dd($cmb);
        $gi = GI::where('id',$id)->first();
        $areas = Organisasi::where('id',$gi->id_organisasi)->first();
        $id_org = substr($areas->id_organisasi, 0, 3) . "%%";
        $area = Organisasi::where('id_organisasi', 'like', $id_org)->where('tipe_organisasi', 2)->first();
        $penyulang_array = array();
        $list_array = array();

        for ($i=0; $i < count($cmb->trafo); $i++) {
            $py = Penyulang::where('id_trafo_gi',$cmb->trafo[$i]['id'])->get();
            for ($j=0; $j < count($py); $j++) {
                $penyulang = PenyimpananPenyulang::where([
                    ['id_penyulang', $py[$j]['id']],
                    ['periode', date("Ym")-1]
                ])->get();
                $penyulang_ = PenyimpananPenyulang::where([
                    ['id_penyulang', $py[$j]['id']],
                    ['periode', date("Ym")]
                ])->get();
                if(count($penyulang) >0)
                    $dt = $penyulang[0]['data'];
                else $dt = "";
                if(count($penyulang_) >0)
                    $dt_ = $penyulang_[0]['data'];
                else $dt_ = "";
                $dtpenyulang = array(
                    'nama' => $py[$j]['nama_penyulang'],
                    'data_master' => $py[$j]['data_master'],
                    'data' => $dt,
                    'data_' => $dt_,
                    'id_penyulang' => $py[$j]['id'],
                    'id_trafo' => $py[$j]['id_trafo_gi'],
                );
                array_push($penyulang_array,$dtpenyulang);
            }
        }

        $total_lwbp1 = $total_lwbp2 = $total_wbp =$total= null;
        $total_lwbp1_ = $total_lwbp2_ = $total_wbp_ =$total_= null;
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
//                        echo $hasil_lwbp1."sadasdsa";
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
            if($total_lwbp1==0)$total_lwbp1=null;
            if($total_lwbp2==0)$total_lwbp2=null;
            if($total_wbp==0)$total_wbp=null;
            if($total_lwbp1+$total_lwbp1+$total_lwbp1==0)$total=null;
            else $total =$total_lwbp1+$total_lwbp2+$total_wbp;
            if($total_lwbp1_==0)$total_lwbp1_=null;
            if($total_lwbp2_==0)$total_lwbp2_=null;
            if($total_wbp_==0)$total_wbp_=null;
            if($total_lwbp1_+$total_lwbp1_+$total_lwbp1_==0)$total_=null;
            else $total_=$total_lwbp1_+$total_lwbp2_+$total_wbp_;
            $pemakaian_penyulang = array(
                'pemakaian_lwbp1' => $total_lwbp1,
                'pemakaian_lwbp2' => $total_lwbp2,
                'pemakaian_wbp' => $total_wbp,
                'total_pemakaian_energi' => $total,
                'pemakaian_lwbp1_' => $total_lwbp1_,
                'pemakaian_lwbp2_' => $total_lwbp2_,
                'pemakaian_wbp_' => $total_wbp_,
                'total_pemakaian_energi_' => $total_,
            );
            array_push($list_array,$pemakaian_penyulang);
            $total_lwbp1 = $total_lwbp2 = $total_wbp = null;
            $hasil_lwbp1= $hasil_lwbp2 = $hasil_wbp= $total=null;
            $total_lwbp1_ = $total_lwbp2_ = $total_wbp_ =$total_= null;
            $hasil_lwbp1_= $hasil_lwbp2_= $hasil_wbp_= null;
        }
        $trafo_GI = array();
        $tr = TrafoGI::whereIn('id',$cmb->id)->get();
        for ($i=0; $i < count($cmb->id); $i++) {
            $p_tr = PenyimpananTrafoGI::where([
                ['id_trafo_gi', $tr[$i]['id']],
                ['periode', date("Ym")-1]
            ])->first();

            $p_tr_ = PenyimpananTrafoGI::where([
                ['id_trafo_gi', $tr[$i]['id']],
                ['periode', date("Ym")]
            ])->first();
            if(count($p_tr) >0)
                $dt = $p_tr[0]['data'];
            else $dt = "";
            if(count($p_tr_) >0)
                $dt_ = $p_tr_['data'];
            else $dt_ = "";

            $zero = json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']*100;
            $zero_p =json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']*100;
            $zero_s =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])*100;
            if($zero==0)$zero=1;
            if($zero_s==0)$zero_s=1;
            if($zero_p==0)$zero_p=1;

            $s_out= abs(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])
            /$zero;
            $p_out =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
            /$zero;
            $selisih = abs(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']-$list_array[$i]['total_pemakaian_energi_'])
            /$zero_s;
            $persen =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
                /$zero_p;
            $dttrafo = array(
                'nama' => $tr[$i]['nama_trafo_gi'],
                'data_master' => $tr[$i]['data_master'],
                'data' => $dt,
                'data_' => $dt_,
                's_out' => $selisih,
                'p_out' => $persen,
                's_pembanding' => $s_out,
                'p_pembanding' => $p_out,
                'id_trafo' => $tr[$i]['id'],
            );
            array_push($trafo_GI,$dttrafo);

        }
        $list_data_trafo = array();
        $trafo = array();
        for ($i=0; $i < count($cmb->trafo); $i++) {
            for ($j=0; $j < count($penyulang_array); $j++) {
                if($cmb->trafo[$i]['id']== $penyulang_array[$j]['id_trafo'])
                    array_push($trafo,$penyulang_array[$j]);
            }
            array_push($list_data_trafo,$trafo);
            $trafo = array();
        }
//        dd($list_data_trafo);
//        $tot = json_decode($list_data_trafo[0][0]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
//        -json_decode($list_data_trafo[0][0]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'];
//        dd($penyulang_array);

        $arr_sum_=array();$deviasi = array();
        for ($i=0; $i < count($list_data_trafo); $i++) {
            $tot_penyulang =0;
            $a =$list_array[$i]['total_pemakaian_energi_'];
            if($list_array[$i]['total_pemakaian_energi_']==0)$a =1;
            $C = (json_decode($trafo_GI[$i]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                - json_decode($trafo_GI[$i]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])/$a;
            for ($j=0; $j < count($list_data_trafo[$i]); $j++) {
                $dev = $C *(json_decode($list_data_trafo[$i][$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
                $tot_penyulang+=$dev;
                $ar =array(
                    'deviasi' => $dev,
                    'id_trafo' => $list_data_trafo[$i][$j]['id_trafo']

                );
                array_push($deviasi, $ar);
            }
            array_push($arr_sum_,$tot_penyulang);
        }
//

//      


//        dd((json_decode($penyulang_array[0]['data'], true)['hasil_pengolahan']['visual']));

//        dd($list_array);

        $sum =0; $sum_ =0;
        for ($j=0; $j < count($penyulang_array); $j++){
            if($penyulang_array[$j]['id_trafo']== $cmb->trafo[0]->id){
                $sum +=(json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])+(json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']);
                $sum_ +=(json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])
                /($list_array[0]['total_pemakaian_energi_'])*(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
            }
        }

//        $list_array BUAT Total P.E. per Trafo di GI
//        $penyulang_array Data SEMUA Penyulang di GI
//        dd($penyulang_array);
        $no_trafo =0;
        $list_p = array();
        for($no_penyulang=0;$no_penyulang< count($penyulang_array);$no_penyulang++){
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
//      $KWH_bulan_lalu = 2714687;

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
            array_push($list_p,$data_keluar);
        }

        return view('admin.nonmaster.laporan.gi',[
            'data'      => $cmb,
            'penyulang' => $penyulang_array,
            'pemakaian' => $list_array,
            'dt_trafo' => $list_data_trafo,
            'data_master' => $trafo_GI,
            'deviasi' => $deviasi,
            'sum'       => $sum,
            'sum_'       => $arr_sum_,
            'gi'        => $gi,
            'area'      => $area->nama_organisasi
        ]);
    }
}
