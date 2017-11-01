<?php

namespace App\Http\Controllers;

use App\GI;
use App\Organisasi;
use App\PenyimpananGardu;
use App\PenyimpananGI;
use App\PenyimpananPenyulang;
use App\PenyimpananTrafoGI;
use App\TrafoGI;
use Illuminate\Http\Request;
use App\Penyulang; 
use App\Gardu;
use Illuminate\Support\Facades\Auth; 
use phpDocumentor\Reflection\Types\Null_;
use Excel;

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

//    	dd($data_hasil_pengolahan_penyulang);

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
        if($tipe == 'gtt_pct')
            $tipe = 'gd';
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

    public function data_penyulang($trafo){
        $penyulang_array = array();
        for ($i=0; $i < count($trafo); $i++) {
            $py = Penyulang::select('nama_penyulang','id_organisasi as id_org' ,'data_master','id','id_trafo_gi')->where('id_trafo_gi',$trafo[$i]['id'])->get();
            for ($j=0; $j < count($py); $j++) {
                $org = Organisasi::select('nama_organisasi')->where('id',$py[$j]['id_org'])->first();
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
                    'nama_org' => $org->nama_organisasi,
                    'id_trafo' => $py[$j]['id_trafo_gi'],
                );
                array_push($penyulang_array,$dtpenyulang);
            }
        }
        return $penyulang_array;
    }

    public function total_pemakaian_energi($id, $penyulang_array){
        $list_array =array();
        for ($i=0; $i < count($id); $i++) {
            $total_lwbp1 = $total_lwbp2 = $total_wbp =$total= null;
            $total_lwbp1_ = $total_lwbp2_ = $total_wbp_ =$total_= null;
            $hasil_lwbp1 = null; $hasil_lwbp2=null; $hasil_wbp=null;
            $hasil_lwbp1_=null; $hasil_lwbp2_=null; $hasil_wbp_=null;
            for ($j = 0; $j < count($penyulang_array); $j++) {
                if ($penyulang_array[$j]['id_trafo'] == $id[$i]) {
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
//                        echo $total_lwbp1+$total_lwbp2+$total_wbp."awal";
                    }
                    if($penyulang_array[$j]['data_']== ""){
                        $hasil_lwbp1_=null; $hasil_lwbp2_=null; $hasil_wbp_=null;
                    }
                    else{
//                        DOWNLOAD
                        $hasil_lwbp1_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp1_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp1_download']);
                        $hasil_lwbp2_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['lwbp2_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['lwbp2_download']);
                        $hasil_wbp_ = (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['visual']['wbp_visual'])
                            + (json_decode($penyulang_array[$j]['data_'], true)['hasil_pengolahan']['download']['wbp_download']);
                        $total_lwbp1_ += $hasil_lwbp1_;
                        $total_lwbp2_ += $hasil_lwbp2_;
                        $total_wbp_ += $hasil_wbp_;
//                        echo $total_lwbp1_+$total_lwbp2_+$total_wbp_."akhir";
                    }
                }
            }
            if($total_lwbp1==0)$total_lwbp1=null;
            if($total_lwbp2==0)$total_lwbp2=null;
            if($total_wbp==0)$total_wbp=null;
            $total =$total_lwbp1+$total_lwbp2+$total_wbp;
            if($total==0)$total=null;
            if($total_lwbp1_==0)$total_lwbp1_=null;
            if($total_lwbp2_==0)$total_lwbp2_=null;
            if($total_wbp_==0)$total_wbp_=null;
            $total_ =$total_lwbp1_+$total_lwbp2_+$total_wbp_;
            if($total_==0)$total_=null;
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

        }
//        dd($list_array);
        return $list_array;
    }

    public function data_trafo($id,$list_array){
        $trafo_GI =array();
        $tr = TrafoGI::whereIn('id',$id)->get();

        for ($i=0; $i < count($id); $i++) {

            $p_tr = PenyimpananTrafoGI::where([
                ['id_trafo_gi', $tr[$i]['id']],
                ['periode', "L".(date("Ym")-1)]
            ])->first();
            if($p_tr==null)
                $p_tr = PenyimpananTrafoGI::where([
                    ['id_trafo_gi', $tr[$i]['id']],
                    ['periode', date("Ym")-1]
                ])->first();

            $p_tr_ = PenyimpananTrafoGI::where([
                ['id_trafo_gi', $tr[$i]['id']],
                ['periode', date("Ym")]
            ])->first();
            if(count($p_tr) >0)
                $dt = $p_tr['data'];
            else $dt = "";
            if(count($p_tr_) >0)
                $dt_ = $p_tr_['data'];
            else $dt_ = "";

            $zero = json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download'];
            $zero_p =json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'];
            $zero_s =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
            if($zero==0)$zero=1;
            if($zero_s==0)$zero_s=1;
            if($zero_p==0)$zero_p=1;

            $s_out= abs(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual'])
                /$zero*100;
            $p_out =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
                /$zero*100;
            $selisih = abs(
                (json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                    -json_decode($p_tr_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']-$list_array[$i]['total_pemakaian_energi_'])
                /($zero_s))*100;
//          download ps =  $list_array[$i]['total_pemakaian_energi_'];
            $selisih_ps = abs(
                    (json_decode($p_tr_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                        -json_decode($p_tr_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']-0)
                    /($zero_s))*100;

            $persen =(json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']-json_decode($p_tr_['data'],true)['hasil_pengolahan']['pembanding']['download']['total_pemakaian_kwh_download'])
                /$zero_p*100;

            $dttrafo = array(
                'nama' => $tr[$i]['nama_trafo_gi'],
                'data_master' => $tr[$i]['data_master'],
                'data' => $dt,
                'data_' => $dt_,
                's_ps' => $selisih_ps,
                's_out' => $selisih,
                'p_out' => $persen,
                's_pembanding' => $s_out,
                'p_pembanding' => $p_out,
                'id_trafo' => $tr[$i]['id'],
            );
            array_push($trafo_GI,$dttrafo);
        }
        return $trafo_GI;
    }

    public function view_beli($id_rayon,$tipe,$id){
        $cmb = new MasterLaporan($id_rayon,"tsa",$id);
        $gi = GI::where('id',$id)->first();
        $areas = Organisasi::where('id',$gi->id_organisasi)->first();
        $id_org = substr($areas->id_organisasi, 0, 3) . "%%";
        $area = Organisasi::where('id_organisasi', 'like', $id_org)->where('tipe_organisasi', 2)->first();

        $penyulang_array =$this->data_penyulang($cmb->trafo);
        $list_array = $this->total_pemakaian_energi($cmb->id, $penyulang_array);
//        dd($list_array);
        $trafo_GI = $this->data_trafo($cmb->id,$list_array);

//        dd(json_decode($trafo_GI[0]['data_'],true)['hasil_pengolahan']);
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

        $arr_sum_=array();$deviasi = array();
        for ($i=0; $i < count($list_data_trafo); $i++) {
            $tot_penyulang =0;
            $a =$list_array[$i]['total_pemakaian_energi_'];
            if($a==0)$a =1;
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

        $sum = array();
        for($i=0;$i<count($trafo_GI);$i++){
            $sum_=0;
            for ($j=0; $j < count($penyulang_array); $j++){
                if($penyulang_array[$j]['id_trafo']== $cmb->trafo[$i]->id){
                    $sum_ +=(json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])+
                        (json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']);
                }
            }
            array_push($sum,$sum_);
        }

        for($tr=0;$tr<count($trafo_GI);$tr++){
            $p_trafo = PenyimpananTrafoGI::where('id_trafo_gi', $trafo_GI[$tr]['id_trafo'])->where('periode',date('Ym'))->first();
            if($p_trafo){
                //        TPE Penyulang
                $A = $list_array[0]['total_pemakaian_energi_'];
//        Selisih TPE Trafo (Utama -Utama PS)
                $B = json_decode($trafo_GI[$tr]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                    -json_decode($trafo_GI[$tr]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'];
                $data_trafo = array(
                    'TPE_Penyulang' => $A,
                    'Selisih_TPE' => $B,
                );
                $p_trafo->data_keluar = json_encode($data_trafo);
                if($p_trafo->save());
            }
        }
//        dd($trafo_GI);

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
            'area'      => $area->nama_organisasi,
            'id_organisasi' =>$id_rayon,
            'tipe'      =>$tipe,
            'id'        =>$id
        ]);
    }

    public function data_tsa($id_organisasi,$tipe,$data_gi){
        $cmb = new MasterLaporan($id_organisasi,$tipe,$data_gi->id);
        if($cmb){
            $penyulang_array =$this->data_penyulang($cmb->trafo);
            $list_array = $this->total_pemakaian_energi($cmb->id, $penyulang_array);
            $list_p = array();
            $jumlah_trafo = array();
            $trafo = TrafoGI::select('nama_trafo_gi','id','id_gi')->where('id_gi',$data_gi->id)->get()->toArray();

            $tot_lwbp1 = $tot_lwbp2 = $tot_wbp =$tot_t_kwh = $tot_Kvarh = $tot_KW = $tot_KWH = $tot_KWH_lalu=$tot_jual = null;
            for ($i=0;$i<count($cmb->trafo);$i++){
                $p_trafo_ = PenyimpananTrafoGI::select('data','id_trafo_gi')->where('id_trafo_gi',$trafo[$i]['id'])->where('periode', date('Ym'))->first();
                $trafo_lwbp1 = $trafo_lwbp2 = $trafo_wbp = $trafo_t_kwh = $trafo_Kvarh = $trafo_KW = $trafo_KWH = $trafo_KWH_lalu = $trafo_jual= null;
                for($j=0;$j< count($penyulang_array);$j++){
                    if($trafo[$i]['id'] == $penyulang_array[$j]['id_trafo']){
                        if($p_trafo_){
                            if(json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']>0){
                                $A_lwbp1 = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['download']['lwbp1_download']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual']);
                                $A_lwbp2 = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['download']['lwbp2_download']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual']);
                                $A_wbp   = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['download']['wbp_download']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual']);
                                $B = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                                    -json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
                            }
                            else{
                                $A_lwbp1 = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['visual']['lwbp1_visual']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp1_visual']);
                                $A_lwbp2 = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['visual']['lwbp2_visual']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['lwbp2_visual']);
                                $A_wbp   = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['visual']['wbp_visual']-json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['wbp_visual']);
                                $B = (json_decode($p_trafo_['data'],true)['hasil_pengolahan']['utama']['visual']['total_pemakaian_kwh_visual']
                                    -json_decode($p_trafo_['data'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
                            }
                            $var =($list_array[$i]['total_pemakaian_energi_']);
                            if($var==0)$var=1;
                            if($B==0)$B=1;

                            if((json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']>0))
                                $C = $B/$var*(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']);
                            else
                                $C = $B/$var*(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
//                            $kvar =json_decode($p_trafo_['data'],true)['beli']['utama']['visual']['kvarh_visual'];

                            $KWH_salur_lwbp1 = intval((($A_lwbp1/$B*$C/1) + 0.5 )*1);
                            $KWH_salur_lwbp2 = intval((($A_lwbp2/$B*$C/1) + 0.5 )*1);
                            $KWH_salur_wbp = intval((($A_wbp/$B*$C/1) + 0.5 )*1);
                            $kvar =$C/$B*json_decode($p_trafo_['data'],true)['beli']['utama']['download']['kvarh_download'];

                            //      INI DITANYAIN BIKIN FORM ATAU TIDAK??? KALO IYA DIMASUKIN ke Penyimpanan Trafo GI
                            $daya_konsiden_utama = (json_decode($p_trafo_['data'],true)['beli']['utama']['download']['konsiden_download']);
                            $daya_konsiden_ps = (json_decode($p_trafo_['data'],true)['beli']['ps']['visual']['konsiden_visual']);
                            $D = $daya_konsiden_utama -$daya_konsiden_ps;
                            //        $i = (json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']
                            //            - json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
                            //        $c = $i / ($list_array[0]['total_pemakaian_energi_'])*(json_decode($penyulang_array[0]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
                            //        $KW = intval(($c/$B*$D) + 0.5 )* 1;

                            $c = 1 / $var*(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
                            $KW =   intval((($c*$D) + 0.5 )* 1);
                            $total_kwh = $KWH_salur_lwbp1+$KWH_salur_lwbp2+$KWH_salur_wbp;

                            $KWH_bulan_lalu = PenyimpananPenyulang::where('id_penyulang',$penyulang_array[$j]['id_penyulang'])->where('periode',"L".(date('Ym')-1))->first();
                            if($KWH_bulan_lalu==null)
                                $KWH_bulan_lalu = PenyimpananPenyulang::where('id_penyulang',$penyulang_array[$j]['id_penyulang'])->where('periode',date('Ym')-1)->first();
//                            dd(json_decode($bulan_lalu->data,true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']);
//                            $KWH_bulan_lalu = json_decode($bulan_lalu->data,true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download'];
//                            dd($KWH_bulan_lalu);
                            $KWH = null;
                            if(($KWH_bulan_lalu) == null||$KWH_bulan_lalu->data_keluar==null ){
                                $KWH_bulan_lalu = null;
                                $KWH = $total_kwh - $KWH_bulan_lalu;
                                $persen = null;
                            }
                            else{
                                $KWH_bulan_lalu= json_decode($KWH_bulan_lalu->data_keluar,true)['total_kwh'];
                                if($KWH_bulan_lalu==null)
                                    $persen =0;
                                else{
                                    $KWH = $total_kwh - $KWH_bulan_lalu;
                                    $persen = $KWH/$KWH_bulan_lalu*100;
                                }
                            }
                            //      KOLOM N, O
                            $p_penyulang = PenyimpananPenyulang::where('id_penyulang',$penyulang_array[$j]['id_penyulang'])->where('periode',date('Ym'))->first();
                            $data_keluar = array(
                                'dev_lwbp1' =>$KWH_salur_lwbp1,
                                'dev_lwbp2' =>$KWH_salur_lwbp2,
                                'dev_wbp' =>$KWH_salur_wbp,
                                'dev_kvar' =>$kvar,
                                'dev_kw' =>$KW,
                                'total_kwh' =>$total_kwh,
                            );
                            if($p_penyulang){
                                $p_penyulang->data_keluar = json_encode($data_keluar);
                                if($p_penyulang->save());
                            }
                            $trafo_lwbp1 += $KWH_salur_lwbp1;
                            $trafo_lwbp2 += $KWH_salur_lwbp2;
                            $trafo_wbp += $KWH_salur_wbp;
                            $trafo_t_kwh += $total_kwh;
                            $trafo_KW += $KW;
                            $trafo_Kvarh += $kvar;
                            $trafo_KWH += $KWH;
                            $trafo_KWH_lalu += $KWH_bulan_lalu;
//                            $jual = 1000000;
                            $jual =   json_decode($penyulang_array[$j]['data_'],true)['jual']['total_kwh_jual'];
                            if(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']==0)
                                $ujung =json_decode($penyulang_array[$j]['data_'],true)['beli']['visual']['tu_visual'];
                            else $ujung =json_decode($penyulang_array[$j]['data_'],true)['beli']['download']['tu_download'];
                            $susut =   $total_kwh-$jual;
                            $trafo_jual += $jual;
                            if($total_kwh==0) $losses=0;
                            else $losses =  $susut/$total_kwh*100;
                            $data_keluar = array(
                                'id_trafo' => $penyulang_array[$j]['id_trafo'],
                                'nama_t' => $trafo[$i]['nama_trafo_gi'],
                                'nama_p' => $penyulang_array[$j]['nama'],
                                'ujung' => $ujung,
                                'lwbp1' => $KWH_salur_lwbp1,
                                'lwbp2' => $KWH_salur_lwbp2,
                                'wbp'   => $KWH_salur_wbp,
                                'total_kwh' => $total_kwh,
                                'rayon' => $penyulang_array[$j]['nama_org'],
                                'Kvarh' => $kvar,
                                'KW' => $KW,
                                'KWH'   => $KWH,
                                'KWH_lalu'   => $KWH_bulan_lalu,
                                'jual'   => $jual,
                                'susut'   => $susut,
                                'losses'   => $losses,
                                'persen' => $persen
                            );
                            array_push($list_p,$data_keluar);

//                            dd(json_decode($penyulang_array[$j]['data_'],true)['jual']['total_kwh_jual']);
                        }
                        else {
//                      Query
                            $KWH_bulan_lalu = 0;
                            $data_keluar = array(
                                'id_trafo' => $penyulang_array[$j]['id_trafo'],
                                'nama_t' => $trafo[$i]['nama_trafo_gi'],
                                'nama_p' => $penyulang_array[$j]['nama'],
                                'ujung' => null,
                                'lwbp1' => null,
                                'lwbp2' => null,
                                'wbp'   => null,
                                'total_kwh' => null,
                                'rayon' => $penyulang_array[$j]['nama_org'],
                                'Kvarh' => null,
                                'KW' => null,
                                'KWH'   => null,
                                'KWH_lalu'   => $KWH_bulan_lalu,
                                'jual'   => null,
                                'susut'   => null,
                                'losses'   => null,
                                'persen' => null
                            );
                            array_push($list_p,$data_keluar);
                        }
                    }
                    $trafo_KWH = $trafo_t_kwh - $trafo_KWH_lalu;
                    if($trafo_KWH_lalu == 0)$trafo_persen=0;
                    else $trafo_persen = $trafo_KWH/$trafo_KWH_lalu*100;
                    $trafo_susut = $trafo_t_kwh - $trafo_jual;
                    if($trafo_t_kwh==0) $trafo_losses = 0;
                    else $trafo_losses = $trafo_susut / $trafo_t_kwh *100;
//                    dd($list_p);

                    $jumlah_pemakaian =array(
                        'id_trafo' => $trafo[$i]['id'],
                        'lwbp1' => $trafo_lwbp1,
                        'lwbp2' => $trafo_lwbp2,
                        'wbp' => $trafo_wbp,
                        'total_kwh' => $trafo_t_kwh,
                        'Kvarh' => $trafo_Kvarh,
                        'KW' => $trafo_KW,
                        'KWH'   => $trafo_KWH,
                        'KWH_lalu'   => $trafo_KWH_lalu,
                        'persen' => $trafo_persen,
                        'jual'   => $trafo_jual,
                        'susut'   => $trafo_susut,
                        'losses'   => $trafo_losses,
                    );
                }
                $tot_lwbp1 += $trafo_lwbp1;
                $tot_lwbp2 += $trafo_lwbp2;
                $tot_wbp += $trafo_wbp;
                $tot_t_kwh += $trafo_t_kwh;
                $tot_KWH_lalu+=$trafo_KWH_lalu;
                $tot_KW +=$trafo_KW;
                $tot_Kvarh +=$trafo_Kvarh;
                $tot_KWH = $tot_t_kwh - $tot_KWH_lalu;
                $tot_jual+=$trafo_jual;
                array_push($jumlah_trafo,$jumlah_pemakaian);
            }

            if($tot_KWH_lalu == 0)$tot_persen = 0;
            else $tot_persen = $tot_KWH/$tot_KWH_lalu*100;
            $tot_susut = $tot_t_kwh -$tot_jual;
            if($tot_t_kwh==0) $tot_losses = 0;
            else $tot_losses = $tot_susut / $tot_t_kwh *100;

            $jumlah_tot =array(
                'lwbp1' => $tot_lwbp1,
                'lwbp2' => $tot_lwbp2,
                'wbp' => $tot_wbp,
                'total_kwh' => $tot_t_kwh,
                'Kvarh' => $tot_Kvarh,
                'KW' => $tot_KW,
                'KWH'   => $tot_KWH,
                'KWH_lalu'   => $tot_KWH_lalu,
                'persen' => $tot_persen,
                'jual'   => $tot_jual,
                'susut'   => $tot_susut,
                'losses'   => $tot_losses,
            );

        }
//        dd($jumlah_tot);
        return array($trafo,$list_p,$jumlah_trafo,$jumlah_tot);
    }

    public function view_beli_tsa($id_organisasi, $tsa, $tipe){
        $id_tsa = $tsa;
        if($tipe =="gi"||$tipe =="penyulang"){
            $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
//            dd($tipe);
            $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
            $tsa_ = array();$trafo = array();$list_p = array();$nama_gi = array();$jumlah_trafo = array();$jumlah_tot = array();
            for($i =0 ;$i <count($id_org);$i++) {
                $data_gi = GI::where('id_organisasi', $id_org[$i])->select('id', 'nama_gi','id_organisasi')->get();
//                dd($data_gi);
                if ($data_gi) {
                    for($j =0 ;$j <count($data_gi);$j++) {
                        $data = $this->data_tsa($id_organisasi, "tsa", $data_gi[$j]);
                        if($data[2]){
                            if($data[0])
                                array_push($trafo,$data[0]);
                            if($data[1])
                                array_push($list_p,$data[1]);
                            if($data[2])
                                array_push($jumlah_trafo,$data[2]);
                            if($data[3])
                                array_push($jumlah_tot,$data[3]);
                            $dt = array(
                                'nama' => $data[1][0]['rayon'],
                                'trafo' => $data[0],
                                'list_p' => $data[1],
                                'jumlah_trafo' => $data[2],
                                'jumlah_tot' => $data[3],
                            );
                            array_push($nama_gi,$data_gi[$j]);
                            array_push($tsa_,$dt);
                        }
                    }
                }
            }

            $jumlah_gi = array();
            for($i=0;$i<count($jumlah_trafo);$i++){
                $lwbp1_gi = $lwbp2_gi = $wbp_gi =$tpe_kwh_gi = $Kvarh_gi =$KW_gi = $KWH_gi = $KWH_lalu_gi=$jual_gi= null;
                for($j=0;$j<count($jumlah_trafo[$i]);$j++){
                    $lwbp1_gi +=$jumlah_trafo[$i][$j]['lwbp1'];
                    $lwbp2_gi +=$jumlah_trafo[$i][$j]['lwbp2'];
                    $wbp_gi +=$jumlah_trafo[$i][$j]['wbp'];
                    $tpe_kwh_gi +=$jumlah_trafo[$i][$j]['total_kwh'];
                    $Kvarh_gi +=$jumlah_trafo[$i][$j]['Kvarh'];
                    $KW_gi +=$jumlah_trafo[$i][$j]['KW'];
                    $KWH_gi +=$jumlah_trafo[$i][$j]['KWH'];
                    $KWH_lalu_gi+=$jumlah_trafo[$i][$j]['KWH_lalu'];
                    $jual_gi+=$jumlah_trafo[$i][$j]['jual'];
                }

                if($KWH_lalu_gi == 0)$persen_gi =0;
                else $persen_gi = $KWH_gi/$KWH_lalu_gi*100;
                $susut_gi = $tpe_kwh_gi -$jual_gi;
                if($tpe_kwh_gi==0) $losses_gi = 0;
                else $losses_gi = $susut_gi / $tpe_kwh_gi *100;
                $dt_gi =array(
                    'lwbp1' => $lwbp1_gi,
                    'lwbp2' => $lwbp2_gi,
                    'wbp' => $wbp_gi,
                    'total_kwh' => $tpe_kwh_gi,
                    'KW' => $KW_gi,
                    'Kvarh'   => $Kvarh_gi,
                    'KWH'   => $KWH_gi,
                    'KWH_lalu'   => $KWH_lalu_gi,
                    'persen' => $persen_gi,
                    'jual'   => $jual_gi,
                    'susut'   => $susut_gi,
                    'losses'   => $losses_gi
                );
                array_push($jumlah_gi,$dt_gi);
            }

            $tot_lwbp1 = $tot_lwbp2 = $tot_wbp = $tot_Kvarh =$tot_t_kwh = $tot_KW = $tot_KWH = $tot_KWH_lalu=$tot_jual= null;
            for($i=0;$i < count($jumlah_gi);$i++){
                $tot_lwbp1 += $jumlah_gi[$i]['lwbp1'];
                $tot_lwbp2 += $jumlah_gi[$i]['lwbp2'];
                $tot_wbp += $jumlah_gi[$i]['wbp'];
                $tot_Kvarh += $jumlah_gi[$i]['Kvarh'];
                $tot_t_kwh += $jumlah_gi[$i]['total_kwh'];
                $tot_KWH_lalu+=$jumlah_gi[$i]['KWH_lalu'];
                $tot_KW +=$jumlah_gi[$i]['KW'];
                $tot_KWH += $jumlah_gi[$i]['KWH'];
                $tot_jual += $jumlah_gi[$i]['jual'];
            }

            if($tot_KWH_lalu == 0)$tot_persen =0;
            else $tot_persen = $tot_KWH/$tot_KWH_lalu*100;
            $tot_susut = $tot_t_kwh -$tot_jual;
            if($tot_t_kwh==0) $tot_losses = 0;
            else $tot_losses = $tot_susut / $tot_t_kwh *100;

            $jumlah_tot =array(
                'lwbp1' => $tot_lwbp1,
                'lwbp2' => $tot_lwbp2,
                'wbp' => $tot_wbp,
                'total_kwh' => $tot_t_kwh,
                'KW' => $tot_KW,
                'Kvarh'   => $tot_Kvarh,
                'KWH'   => $tot_KWH,
                'KWH_lalu'   => $tot_KWH_lalu,
                'persen' => $tot_persen,
                'jual'   => $tot_jual,
                'susut'   => $tot_susut,
                'losses'   => $tot_losses
            );

//                dd($jumlah_gi);
            if($tipe =="gi"){

                $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
                $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
                $gi = GI::whereIn('id_organisasi',$id_org)->get()->toArray();

                $arr_rayon = array();
                for($i=0;$i<count($id_org);$i++){
                    $arr_gi = array();
                    for($j=0;$j<count($gi);$j++){
                        if($data_org[$i]['id']==$gi[$j]['id_organisasi'])
                            array_push($arr_gi,$gi[$j]);
                    }
                    array_push($arr_rayon,$arr_gi);
                }
                $rayon = array();
                for($i=0;$i<count($arr_rayon);$i++){
                    $lwbp1 =$lwbp2 =$wbp =$total_kwh =$Kvarh =$KW =$KWH =$KWH_lalu =$jual = null;$stop = 0;
                    if($arr_rayon[$i]==[]){
                        $dt = array(
                            'nama_rayon' => $data_org[$i]['nama_organisasi'],
                            'lwbp1' => null,
                            'lwbp2' => null,
                            'wbp' => null,
                            'total_kwh' => null,
                            'Kvarh' => null,
                            'KW' => null,
                            'KWH'   => null,
                            'KWH_lalu'   => null,
                            'persen' => null,
                            'jual'   => null,
                            'susut'   => null,
                            'losses'   => null,
                        );
                    }
                    else{
                        for($j=0;$j<count($jumlah_gi);$j++){
                            if($arr_rayon[$i][$stop]['id_organisasi']==$nama_gi[$j]['id_organisasi']){
                                $lwbp1 += $jumlah_gi[$j]['lwbp1'];
                                $lwbp2 += $jumlah_gi[$j]['lwbp2'];
                                $wbp += $jumlah_gi[$j]['wbp'];
                                $total_kwh += $jumlah_gi[$j]['total_kwh'];
                                $Kvarh += $jumlah_gi[$j]['Kvarh'];
                                $KW += $jumlah_gi[$j]['KW'];
                                $KWH += $jumlah_gi[$j]['KWH'];
                                $KWH_lalu += $jumlah_gi[$j]['KWH_lalu'];
                                $jual += $jumlah_gi[$j]['jual'];
                                $stop+=1;
                                if($stop == count($arr_rayon[$i]))break;
                            }
                        }
                        if($KWH_lalu == 0)$persen =0;
                        else $persen = $KWH/$KWH_lalu*100;
                        $susut = $total_kwh -$jual;
                        if($total_kwh==0) $losses = 0;
                        else $losses = $susut / $total_kwh *100;

                        $dt = array(
                            'nama_rayon' => $data_org[$i]['nama_organisasi'],
                            'lwbp1' => $lwbp1,
                            'lwbp2' => $lwbp2,
                            'wbp' => $wbp,
                            'total_kwh' => $total_kwh,
                            'Kvarh' => $Kvarh,
                            'KW' => $KW,
                            'KWH'   => $KWH,
                            'KWH_lalu'   => $KWH_lalu,
                            'persen' => $persen,
                            'jual'   => $jual,
                            'susut'   => $susut,
                            'losses'   => $losses,
                        );
                    }
                    array_push($rayon,$dt);
                }

                $id_rayon = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id');
                $nama_rayon = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('nama_organisasi');
                $cmb = new MasterLaporan($id_rayon,"pct",1);
                $gardu    = $cmb->gardu; $p_penyulang    = $cmb  ->p_penyulang;   $p_gardu  = $cmb->p_gardu;
                $data = $this->data_pct($id_rayon,$p_penyulang,$p_gardu,$gardu,$nama_rayon);
                for($i=0;$i < count($rayon);$i++){
                    $rayon[$i]['lwbp1'] -= $data[5][$i]['lwbp1_e'] + $data[5][$i]['lwbp1_i'];
                    $rayon[$i]['lwbp2'] -= $data[5][$i]['lwbp2_e'] + $data[5][$i]['lwbp2_i'];
                    $rayon[$i]['wbp'] -= $data[5][$i]['wbp_e'] + $data[5][$i]['wbp_i'];
                    $rayon[$i]['Kvarh'] -= $data[5][$i]['kvar_e'] + $data[5][$i]['kvar_i'];
                    $rayon[$i]['KW'] -= $data[5][$i]['kw_e'] + $data[5][$i]['kw_i'];

                    $rayon[$i]['total_kwh'] = $rayon[$i]['lwbp1'] + $rayon[$i]['lwbp2'] + $rayon[$i]['wbp'];
                    $rayon[$i]['KWH'] = $rayon[$i]['total_kwh'] - $rayon[$i]['KWH_lalu'];
                    if ($rayon[$i]['KWH_lalu'] == 0) $rayon[$i]['persen'] = 0;
                    else $rayon[$i]['persen'] = $rayon[$i]['KWH'] / $rayon[$i]['KWH_lalu'] * 100;
                    $rayon[$i]['susut'] = $rayon[$i]['total_kwh'] - $rayon[$i]['jual'];
                    if ($rayon[$i]['total_kwh'] == 0) $rayon[$i]['losses'] = 0;
                    else $rayon[$i]['losses'] = $rayon[$i]['susut'] / $rayon[$i]['total_kwh'] * 100;
                }

                $tot_lwbp1 = $tot_lwbp2 = $tot_wbp =$tot_Kvarh =$tot_t_kwh = $tot_KW = $tot_KWH = $tot_KWH_lalu=$tot_jual= null;
                for($i=0;$i < count($rayon);$i++){
                    $tot_lwbp1 += $rayon[$i]['lwbp1'];
                    $tot_lwbp2 += $rayon[$i]['lwbp2'];
                    $tot_wbp += $rayon[$i]['wbp'];
                    $tot_t_kwh += $rayon[$i]['total_kwh'];
                    $tot_KWH_lalu+=$rayon[$i]['KWH_lalu'];
                    $tot_Kvarh+=$rayon[$i]['Kvarh'];
                    $tot_KW +=$rayon[$i]['KW'];
                    $tot_KWH += $rayon[$i]['KWH'];
                    $tot_jual += $rayon[$i]['jual'];
                }

                if($tot_KWH_lalu == 0)$tot_persen =0;
                else $tot_persen = $tot_KWH/$tot_KWH_lalu*100;
                $tot_susut = $tot_t_kwh -$tot_jual;
                if($tot_t_kwh==0) $tot_losses = 0;
                else $tot_losses = $tot_susut / $tot_t_kwh *100;

                $jumlah_tot =array(
                    'lwbp1' => $tot_lwbp1,
                    'lwbp2' => $tot_lwbp2,
                    'wbp' => $tot_wbp,
                    'total_kwh' => $tot_t_kwh,
                    'KW' => $tot_KW,
                    'Kvarh'   => $tot_Kvarh,
                    'KWH'   => $tot_KWH,
                    'KWH_lalu'   => $tot_KWH_lalu,
                    'persen' => $tot_persen,
                    'jual'   => $tot_jual,
                    'susut'   => $tot_susut,
                    'losses'   => $tot_losses
                );

//                dd($rayon);
                if($tsa=="area")
                    return view('admin.nonmaster.laporan.tsa_rayon',[
                        'rayon'      => $rayon,
                        'total_jumlah' => $jumlah_tot,
                    ]);
                elseif($tsa=="tsa_area")
                    return view('admin.nonmaster.laporan.tsa_area',[
                        'rayon'      => $rayon,
                        'total_jumlah' => $jumlah_tot,
                    ]);
            }
            elseif($tipe =="area")
                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'trafo'      => $trafo,
                    'nama_gi'      => $nama_gi,
                    'data_gi'      => $list_p,
                    'data_jumlah'      => $jumlah_trafo,
                    'total_jumlah'      => $jumlah_tot,
                    'tipe'      => "area",
                    'tipe_organisasi' => "penyulang",
                    'id_organisasi' => $id_organisasi,
                    'tsa' => $id_tsa
                ]);
            elseif($tipe =="penyulang")
                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'trafo'      => $trafo,
                    'nama_gi'      => $nama_gi,
                    'data_gi'      => $list_p,
                    'data_jumlah'      => $jumlah_trafo,
                    'total_jumlah'      => $jumlah_tot,
                    'tipe_organisasi' => "penyulang",
                    'tipe'      => "area",
                    'id_organisasi' => $id_organisasi,
                    'tsa' => $id_tsa
                ]);
        }
        elseif($tipe = "rayon"){
            $org = Organisasi::select('tipe_organisasi','nama_organisasi')->where('id_organisasi',$id_organisasi)->first();
            $data_gi = GI::where('id_organisasi',$tsa_)->select('id','nama_gi','id_organisasi')->get();
            $gi = array();
            if($data_gi){
                for($i =0 ;$i <count($data_gi);$i++) {
                    $data = $this->data_tsa($id_organisasi, "tsa", $data_gi[$i]);
                    $trafo = $data[0];
                    $list_p = $data[1];
                    $jumlah_trafo = $data[2];
                    $jumlah_tot = $data[3];
                    $dt_GI = array(
                        'gi' => $data_gi[$i]['nama_gi'],
                        'trafo' => $trafo,
                        'data_gi' => $list_p,
                        'data_jumlah' => $jumlah_trafo,
                        'total_jumlah' => $jumlah_tot,
                    );
                    array_push($gi,$dt_GI);
                }
//                dd($gi);
                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'area'      => $org->nama_organisasi,
//                    'gi'      => $data_gi->nama_gi,
//                    'trafo'      => $trafo,
                    'data_gi'      => $gi,
//                    'data_jumlah'      => $jumlah_trafo,
//                    'total_jumlah'      => $jumlah_tot,
                    'tipe'      => "rayon",
                    'tipe_organisasi' => "penyulang",
                    'id_organisasi' => $id_organisasi,
                    'tsa' => $id_tsa
                ]);
            }
            else {
                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'trafo'      => null,
                    'gi'      => null,
                    'area'      => $org->nama_organisasi,
                    'data_gi'      => null,
                    'data_jumlah'      => null,
                    'total_jumlah'      => null,
                    'tipe'      => "rayon",
                    'tipe_organisasi' => "penyulang",
                    'id_organisasi' => $id_organisasi,
                    'tsa' => $id_tsa
                ]);
            }
        }
    }

    public function excel_beli_tsa($id_organisasi, $tsa, $tipe){
        if($tipe =="gi"||$tipe =="penyulang"){
            $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
//            dd($data_org);
            $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
            $tsa = array();$trafo = array();$list_p = array();$nama_gi = array();$jumlah_trafo = array();$jumlah_tot = array();
            for($i =0 ;$i <count($id_org);$i++) {
                $data_gi = GI::where('id_organisasi', $id_org[$i])->select('id', 'nama_gi')->first();
                if ($data_gi) {
                    $data = $this->data_tsa($id_organisasi, "tsa", $data_gi);
                    if($data[2]){
                        if($data[0])
                            array_push($trafo,$data[0]);
                        if($data[1])
                            array_push($list_p,$data[1]);
                        if($data[2])
                            array_push($jumlah_trafo,$data[2]);
                        if($data[3])
                            array_push($jumlah_tot,$data[3]);
                        $dt = array(
                            'nama' => $data[1][0]['rayon'],
                            'trafo' => $data[0],
                            'list_p' => $data[1],
                            'jumlah_trafo' => $data[2],
                            'jumlah_tot' => $data[3],
                        );
                        array_push($nama_gi,$data_gi);
                        array_push($tsa,$dt);
                    }
                  }
            }

            $jumlah_gi = array();
            for($i=0;$i<count($jumlah_trafo);$i++){
                $lwbp1_gi = $lwbp2_gi = $wbp_gi =$tpe_kwh_gi = $Kvarh_gi =$KW_gi = $KWH_gi = $KWH_lalu_gi=$jual_gi= null;
                for($j=0;$j<count($jumlah_trafo[$i]);$j++){
                    $lwbp1_gi +=$jumlah_trafo[$i][$j]['lwbp1'];
                    $lwbp2_gi +=$jumlah_trafo[$i][$j]['lwbp2'];
                    $wbp_gi +=$jumlah_trafo[$i][$j]['wbp'];
                    $tpe_kwh_gi +=$jumlah_trafo[$i][$j]['total_kwh'];
                    $Kvarh_gi +=$jumlah_trafo[$i][$j]['Kvarh'];
                    $KW_gi +=$jumlah_trafo[$i][$j]['KW'];
                    $KWH_gi +=$jumlah_trafo[$i][$j]['KWH'];
                    $KWH_lalu_gi+=$jumlah_trafo[$i][$j]['KWH_lalu'];
                    $jual_gi+=$jumlah_trafo[$i][$j]['jual'];
                }

                if($KWH_lalu_gi == 0)$persen_gi =0;
                else $persen_gi = $KWH_gi/$KWH_lalu_gi*100;
                $susut_gi = $tpe_kwh_gi -$jual_gi;
                if($tpe_kwh_gi==0) $losses_gi = 0;
                else $losses_gi = $susut_gi / $tpe_kwh_gi *100;
                $dt_gi =array(
                    'lwbp1' => $lwbp1_gi,
                    'lwbp2' => $lwbp2_gi,
                    'wbp' => $wbp_gi,
                    'total_kwh' => $tpe_kwh_gi,
                    'KW' => $KW_gi,
                    'Kvarh'   => $Kvarh_gi,
                    'KWH'   => $KWH_gi,
                    'KWH_lalu'   => $KWH_lalu_gi,
                    'persen' => $persen_gi,
                    'jual'   => $jual_gi,
                    'susut'   => $susut_gi,
                    'losses'   => $losses_gi
                );
                array_push($jumlah_gi,$dt_gi);
            }

            $tot_lwbp1 = $tot_lwbp2 = $tot_wbp =$tot_t_kwh = $tot_KW = $tot_KWH = $tot_KWH_lalu=$tot_jual= null;
            for($i=0;$i < count($jumlah_gi);$i++){
                $tot_lwbp1 += $jumlah_gi[$i]['lwbp1'];
                $tot_lwbp2 += $jumlah_gi[$i]['lwbp2'];
                $tot_wbp += $jumlah_gi[$i]['wbp'];
                $tot_t_kwh += $jumlah_gi[$i]['total_kwh'];
                $tot_KWH_lalu+=$jumlah_gi[$i]['KWH_lalu'];
                $tot_KW +=$jumlah_gi[$i]['KW'];
                $tot_KWH += $jumlah_gi[$i]['KWH'];
                $tot_jual += $jumlah_gi[$i]['jual'];
            }

            if($tot_KWH_lalu == 0)$tot_persen =0;
            else $tot_persen = $tot_KWH/$tot_KWH_lalu*100;
            $tot_susut = $tot_t_kwh -$tot_jual;
            if($tot_t_kwh==0) $tot_losses = 0;
            else $tot_losses = $tot_susut / $tot_t_kwh *100;

            $jumlah_tot =array(
                'lwbp1' => $tot_lwbp1,
                'lwbp2' => $tot_lwbp2,
                'wbp' => $tot_wbp,
                'total_kwh' => $tot_t_kwh,
                'KW' => $tot_KW,
                'Kvarh'   => $tot_KWH,
                'KWH'   => $tot_KWH,
                'KWH_lalu'   => $tot_KWH_lalu,
                'persen' => $tot_persen,
                'jual'   => $tot_jual,
                'susut'   => $tot_susut,
                'losses'   => $tot_losses
            );
//            dd($tsa);
            if($tipe =="gi")
                return view('admin.nonmaster.laporan.tsa_rayon',[
                    'nama_gi'      => $tsa,
                    'data_gi'      => $jumlah_gi,
                    'total_jumlah' => $jumlah_tot,
                ]);
            elseif($tipe =="area"){
                Excel::create('laporan TSA Penyulang', function($excel)use($trafo,$nama_gi,$list_p,$jumlah_trafo,$jumlah_tot){

                    $excel->sheet('Laporan TSA Penyulang', function($sheet) use($trafo,$nama_gi,$list_p,$jumlah_trafo,$jumlah_tot) {
                        $sheet->mergeCells('A9:A11');
                        $sheet->mergeCells('B9:D9');
                        $sheet->mergeCells('E9:E11');
                        $sheet->mergeCells('F9:K9');
                        $sheet->mergeCells('L9:L11');
                        $sheet->mergeCells('M9:M11');
                        $sheet->mergeCells('N9:O10');
                        $sheet->mergeCells('P9:P11');

                        $sheet->mergeCells('B10:B11');
                        $sheet->mergeCells('C10:C11');
                        $sheet->mergeCells('D10:D11');
                        $sheet->mergeCells('F10:F11');
                        $sheet->mergeCells('G10:G11');
                        $sheet->mergeCells('H10:H11');
                        $sheet->mergeCells('I10:I11');
                        $sheet->mergeCells('J10:J11');
                        $sheet->mergeCells('K10:K11');



                        $sheet->setPageMargin(0.25);
                        $sheet->setOrientation('landscape');
                        $sheet->loadView('admin.nonmaster.excel.tsa_penyulang',[
                            'trafo'      => $trafo,
                            'nama_gi'      => $nama_gi,
                            'data_gi'      => $list_p,
                            'data_jumlah'      => $jumlah_trafo,
                            'total_jumlah'      => $jumlah_tot,
                            'tipe'      => "area",
                        ]);
                    });
                })
                ->download('xls');
        
                return view('admin.nonmaster.excel.tsa_penyulang',[
                    'trafo'      => $trafo,
                    'nama_gi'      => $nama_gi,
                    'data_gi'      => $list_p,
                    'data_jumlah'      => $jumlah_trafo,
                    'total_jumlah'      => $jumlah_tot,
                    'tipe'      => "area",
                ]);
            }elseif($tipe =="penyulang"){
                Excel::create('laporan TSA Penyulang', function($excel)use($trafo,$nama_gi,$list_p,$jumlah_trafo,$jumlah_tot){

                    $excel->sheet('Laporan TSA Penyulang', function($sheet) use($trafo,$nama_gi,$list_p,$jumlah_trafo,$jumlah_tot) {
                        $sheet->mergeCells('A9:A11');
                        $sheet->mergeCells('B9:D9');
                        $sheet->mergeCells('E9:E11');
                        $sheet->mergeCells('F9:K9');
                        $sheet->mergeCells('L9:L11');
                        $sheet->mergeCells('M9:M11');
                        $sheet->mergeCells('N9:O10');
                        $sheet->mergeCells('P9:P11');

                        $sheet->mergeCells('B10:B11');
                        $sheet->mergeCells('C10:C11');
                        $sheet->mergeCells('D10:D11');
                        $sheet->mergeCells('F10:F11');
                        $sheet->mergeCells('G10:G11');
                        $sheet->mergeCells('H10:H11');
                        $sheet->mergeCells('I10:I11');
                        $sheet->mergeCells('J10:J11');
                        $sheet->mergeCells('K10:K11');



                        $sheet->setPageMargin(0.25);
                        $sheet->setOrientation('landscape');
                        $sheet->loadView('admin.nonmaster.excel.tsa_penyulang',[
                            'trafo'      => $trafo,
                            'nama_gi'      => $nama_gi,
                            'data_gi'      => $list_p,
                            'data_jumlah'      => $jumlah_trafo,
                            'total_jumlah'      => $jumlah_tot,
                            'tipe'      => "area",
                        ]);
                    });
                })
                ->download('xls');
            }
        }
        elseif($tipe = "rayon"){
            $org = Organisasi::select('tipe_organisasi','nama_organisasi')->where('id_organisasi',$id_organisasi)->first();
            $data_gi = GI::where('id_organisasi',$tsa)->select('id','nama_gi')->first();
            if($data_gi){
                $data = $this->data_tsa($id_organisasi, "tsa", $data_gi);
                $trafo =$data[0];
                $list_p =$data[1];
                $jumlah_trafo =$data[2];
                $jumlah_tot =$data[3];
                $nama_gi = $data_gi->nama_gi;
                $nama_organisasi = $org->nama_organisasi;
                Excel::create('laporan TSA Penyulang', function($excel)use($trafo,$nama_gi,$nama_organisasi,$list_p,$jumlah_trafo, $jumlah_tot){

                    $excel->sheet('Laporan TSA Penyulang', function($sheet) use($trafo,$nama_gi,$nama_organisasi,$list_p,$jumlah_trafo, $jumlah_tot) {
                        $sheet->mergeCells('A9:A11');
                        $sheet->mergeCells('B9:D9');
                        $sheet->mergeCells('E9:E11');
                        $sheet->mergeCells('F9:K9');
                        $sheet->mergeCells('L9:L11');
                        $sheet->mergeCells('M9:M11');
                        $sheet->mergeCells('N9:O10');
                        $sheet->mergeCells('P9:P11');

                        $sheet->mergeCells('B10:B11');
                        $sheet->mergeCells('C10:C11');
                        $sheet->mergeCells('D10:D11');
                        $sheet->mergeCells('F10:F11');
                        $sheet->mergeCells('G10:G11');
                        $sheet->mergeCells('H10:H11');
                        $sheet->mergeCells('I10:I11');
                        $sheet->mergeCells('J10:J11');
                        $sheet->mergeCells('K10:K11');



                        $sheet->setPageMargin(0.25);
                        $sheet->setOrientation('landscape');
                        $sheet->loadView('admin.nonmaster.excel.tsa_penyulang',[
                            'trafo'      => $trafo,
                            'gi'      => $nama_gi,
                            'area'      => $nama_organisasi,
                            'data_gi'      => $list_p,
                            'data_jumlah'      => $jumlah_trafo,
                            'total_jumlah'      => $jumlah_tot,
                            'tipe'      => "rayon",
                        ]);
                    });
                })
                ->download('xls');

                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'trafo'      => $trafo,
                    'gi'      => $data_gi->nama_gi,
                    'area'      => $org->nama_organisasi,
                    'data_gi'      => $list_p,
                    'data_jumlah'      => $jumlah_trafo,
                    'total_jumlah'      => $jumlah_tot,
                    'tipe'      => "rayon",
                ]);
            }
            else {
                return view('admin.nonmaster.laporan.tsa_penyulang',[
                    'trafo'      => null,
                    'gi'      => null,
                    'area'      => $org->nama_organisasi,
                    'data_gi'      => null,
                    'data_jumlah'      => null,
                    'total_jumlah'      => null,
                    'tipe'      => "rayon",
                ]);
            }
        }
    }

    public function data_deviasi($data_gi,$id_organisasi){
        $cmb = new MasterLaporan($id_organisasi,"deviasi",$data_gi->id);
        $penyulang_array =$this->data_penyulang($cmb->trafo);
        $total_pemakaian_penyulang = $this->total_pemakaian_energi($cmb->id, $penyulang_array);
        $trafo_GI = $this->data_trafo($cmb->id,$total_pemakaian_penyulang);
        $data_GI = array();
        $tot_D =$tot_E =$tot_F =$tot_G =$tot_H =$tot_I =$tot_J =$tot_K=$tot_L =$tot_M= $tot_N =null;
        for($i=0;$i<count($trafo_GI);$i++){
            $D =(json_decode($trafo_GI[$i]['data_'],true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']);
            $E =(json_decode($trafo_GI[$i]['data_'],true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual']);
            $F = $D-$E;
            $G =(json_decode($trafo_GI[$i]['data_'],true)['hasil_pengolahan']['pembanding']['visual']['total_pemakaian_kwh_visual']);
            $H = $total_pemakaian_penyulang[$i]['total_pemakaian_energi_'];
            $I = abs($D-$G);
            if($D==0)$D =1;
            $J = abs($I/$D*100);
            $K = abs($D-$E-$H);
            if($F==0)$F =1;
            $L = abs($K/$F*100);
            $G_E =$G-$E;
            $M = abs($G -$H);
            if($G-$E==0)$G_E = 1;
            $N = abs($M / ($G_E)*100);
            $data = array(
                'gi' =>$data_gi->nama_gi,
                'trafo' =>$trafo_GI[$i]['nama'],
                'id_trafo' =>$trafo_GI[$i]['id_trafo'],
                'D' => $D, 'E' => $E, 'F' => $F, 'G' => $G, 'H' => $H, 'I' => $I,
                'J' => $J, 'K' => $K, 'L' => $L, 'M' => $M, 'N' => $N
            );
            array_push($data_GI,$data);
            $tot_D +=$D; $tot_E +=$E;$tot_F +=$F;$tot_G +=$G;$tot_H +=$H;$tot_I +=$I;$tot_J +=$J;$tot_K +=$K;$tot_L +=$L;$tot_M +=$M;$tot_N +=$N;
        }
        $jumlah = array(
            'gi' =>$data_gi->nama_gi,
            'D' => $tot_D, 'E' => $tot_E, 'F' => $tot_F, 'G' => $tot_G, 'H' => $tot_H, 'I' => $tot_I,
            'J' => $tot_J, 'K' => $tot_K, 'L' => $tot_L, 'M' => $tot_M, 'N' => $tot_N
        );

        return array ($data_GI, $jumlah);
    }

    public function view_beli_deviasi($id_organisasi, $tipe, $id){
        if($tipe == "area"){
            $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
            $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
            $data_GI = array();
            $jumlah = array();
            $tot_D =$tot_E =$tot_F =$tot_G =$tot_H =$tot_I =$tot_J =$tot_K=$tot_L =$tot_M= $tot_N =null;
            for($i =0 ;$i <count($id_org);$i++){
                $dt = GI::where('id_organisasi',$id_org[$i])->select('id','id_organisasi','nama_gi')->get();
                if(!$dt==null){
                    for($j=0;$j<count($dt);$j++){
                        $data = $this->data_deviasi($dt[$j],$data_org[$i]['id_organisasi']);
                        if($data[0]){
                            array_push($data_GI,$data[0]);
                            array_push($jumlah,$data[1]);
                            $tot_D +=$data[1]['D']; $tot_E +=$data[1]['E'];$tot_F +=$data[1]['F'];$tot_G +=$data[1]['G'];$tot_H +=$data[1]['H'];$tot_I +=$data[1]['I'];$tot_J +=$data[1]['J'];$tot_K +=$data[1]['K'];$tot_L +=$data[1]['L'];$tot_M +=$data[1]['M'];$tot_N +=$data[1]['N'];
                        }
                    }
                }
            }
            $total = array(
                'D' => $tot_D, 'E' => $tot_E, 'F' => $tot_F, 'G' => $tot_G, 'H' => $tot_H, 'I' => $tot_I,
                'J' => $tot_J, 'K' => $tot_K, 'L' => $tot_L, 'M' => $tot_M, 'N' => $tot_N
            );
//            dd(count($data_GI));
            return view('admin.nonmaster.laporan.deviasi',[
                'area'      => 'area',
                'data_GI'   => $data_GI,
                'tipe'      => $tipe,
                'jumlah'      => $jumlah,
                'total'      => $total,
                'id_organisasi' => $id_organisasi,
                'id'        => $id
//                'rayon'     => $org->nama_organisasi,
            ]);
        }
        elseif($tipe == "rayon"){
            $org = Organisasi::select('tipe_organisasi','nama_organisasi')->where('id_organisasi',$id_organisasi)->first();
            $data_gi = GI::where('id_organisasi',$id)->select('id','nama_gi')->first();
            if($data_gi){
                $data = $this->data_deviasi($data_gi,$id_organisasi);
                $data_GI =$data[0];
                $jumlah =$data[1];
//                dd($jumlah);

                return view('admin.nonmaster.laporan.deviasi',[
                    'area'      => 'data',
                    'data_GI'   => $data_GI,
                    'tipe'      => $tipe,
                    'jumlah'      => $jumlah,
                    'rayon'     => $org->nama_organisasi,
                    'id_organisasi' => $id_organisasi,
                    'id'        => $id
                ]);

            }
            elseif(!$data_gi){
                return view('admin.nonmaster.laporan.deviasi',[
                    'area'      => 'null',
                    'data_GI'   => null,
                    'tipe'      => $tipe,
                    'jumlah'      => null,
                    'rayon'     => $org->nama_organisasi,
                    'id_organisasi' => $id_organisasi,
                    'id'        => $id
                ]);
            }
        }
    }

    public function excel_beli_deviasi($id_organisasi, $tipe, $id){
        if($tipe == "area"){
            $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
            $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
            $data_GI = array();
            $jumlah = array();
            $tot_D =$tot_E =$tot_F =$tot_G =$tot_H =$tot_I =$tot_J =$tot_K=$tot_L =$tot_M= $tot_N =null;
            for($i =0 ;$i <count($id_org);$i++){
                $dt = GI::where('id_organisasi',$id_org[$i])->select('id','id_organisasi','nama_gi')->first();
                if(!$dt==null){
                    $data = $this->data_deviasi($dt,$data_org[$i]['id_organisasi']);
                    if($data[0]){
                        array_push($data_GI,$data[0]);
                        array_push($jumlah,$data[1]);
                        $tot_D +=$data[1]['D']; $tot_E +=$data[1]['E'];$tot_F +=$data[1]['F'];$tot_G +=$data[1]['G'];$tot_H +=$data[1]['H'];$tot_I +=$data[1]['I'];$tot_J +=$data[1]['J'];$tot_K +=$data[1]['K'];$tot_L +=$data[1]['L'];$tot_M +=$data[1]['M'];$tot_N +=$data[1]['N'];
                    }
                }
            }
            $total = array(
                'D' => $tot_D, 'E' => $tot_E, 'F' => $tot_F, 'G' => $tot_G, 'H' => $tot_H, 'I' => $tot_I,
                'J' => $tot_J, 'K' => $tot_K, 'L' => $tot_L, 'M' => $tot_M, 'N' => $tot_N
            );
            Excel::create('laporan Deviasi', function($excel)use($data_GI,$tipe,$jumlah,$total){

                $excel->sheet('Laporan Deviasi', function($sheet) use($data_GI,$tipe,$jumlah,$total) {
                    $sheet->mergeCells('I9:N9');
                    $sheet->mergeCells('I10:J10');
                    $sheet->mergeCells('K10:L10');
                    $sheet->mergeCells('M10:N10');

                    $sheet->mergeCells('A9:A11');
                    $sheet->mergeCells('B9:B11');
                    $sheet->mergeCells('C9:C11');
                    $sheet->mergeCells('D9:D11');
                    $sheet->mergeCells('E9:E11');
                    $sheet->mergeCells('F9:F11');
                    $sheet->mergeCells('G9:G11');
                    $sheet->mergeCells('H9:H11');
                    $sheet->mergeCells('O9:O11');
                    

                    $sheet->getStyle('A9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('B9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('F9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('H9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('O9')->getAlignment()->setWrapText(true);

                    $sheet->setPageMargin(0.25);
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('admin.nonmaster.excel.deviasi',[
                        'area'      => 'area',
                        'data_GI'   => $data_GI,
                        'tipe'      => $tipe,
                        'jumlah'      => $jumlah,
                        'total'      => $total,
                    ]);

                });

            })
            ->download('xls');

            return view('admin.nonmaster.excel.deviasi',[
                'area'      => 'area',
                'data_GI'   => $data_GI,
                'tipe'      => $tipe,
                'jumlah'      => $jumlah,
                'total'      => $total,
            ]);
        }
        elseif($tipe == "rayon"){
            $org = Organisasi::select('tipe_organisasi','nama_organisasi')->where('id_organisasi',$id_organisasi)->first();
            $data_gi = GI::where('id_organisasi',$id)->select('id','nama_gi')->first();
            if($data_gi){
                $data = $this->data_deviasi($data_gi,$id_organisasi);
                $data_GI =$data[0];
                $jumlah =$data[1];

                Excel::create('laporan Deviasi', function($excel)use($data_GI,$tipe,$jumlah,$total){

                $excel->sheet('Laporan Deviasi', function($sheet) use($data_GI,$tipe,$jumlah,$total) {
                    $sheet->mergeCells('I9:N9');
                    $sheet->mergeCells('I10:J10');
                    $sheet->mergeCells('K10:L10');
                    $sheet->mergeCells('M10:N10');

                    $sheet->mergeCells('A9:A11');
                    $sheet->mergeCells('B9:B11');
                    $sheet->mergeCells('C9:C11');
                    $sheet->mergeCells('D9:D11');
                    $sheet->mergeCells('E9:E11');
                    $sheet->mergeCells('F9:F11');
                    $sheet->mergeCells('G9:G11');
                    $sheet->mergeCells('H9:H11');
                    $sheet->mergeCells('O9:O11');
                    

                    $sheet->getStyle('A9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('B9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('F9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('H9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('O9')->getAlignment()->setWrapText(true);

                    $sheet->setPageMargin(0.25);
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('admin.nonmaster.excel.deviasi',[
                        'area'      => 'area',
                        'data_GI'   => $data_GI,
                        'tipe'      => $tipe,
                        'jumlah'      => $jumlah,
                        'total'      => $total,
                    ]);

                });

            })
            ->download('xls');

                return view('admin.nonmaster.excel.deviasi',[
                    'area'      => 'data',
                    'data_GI'   => $data_GI,
                    'tipe'      => $tipe,
                    'jumlah'      => $jumlah,
                    'rayon'     => $org->nama_organisasi,
                ]);

            }
            elseif(!$data_gi){
                Excel::create('laporan Deviasi', function($excel)use($data_GI,$tipe,$jumlah,$total){

                $excel->sheet('Laporan Deviasi', function($sheet) use($data_GI,$tipe,$jumlah,$total) {
                    $sheet->mergeCells('I9:N9');
                    $sheet->mergeCells('I10:J10');
                    $sheet->mergeCells('K10:L10');
                    $sheet->mergeCells('M10:N10');

                    $sheet->mergeCells('A9:A11');
                    $sheet->mergeCells('B9:B11');
                    $sheet->mergeCells('C9:C11');
                    $sheet->mergeCells('D9:D11');
                    $sheet->mergeCells('E9:E11');
                    $sheet->mergeCells('F9:F11');
                    $sheet->mergeCells('G9:G11');
                    $sheet->mergeCells('H9:H11');
                    $sheet->mergeCells('O9:O11');
                    

                    $sheet->getStyle('A9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('B9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('F9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('H9')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('O9')->getAlignment()->setWrapText(true);

                    $sheet->setPageMargin(0.25);
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('admin.nonmaster.excel.deviasi',[
                        'area'      => 'area',
                        'data_GI'   => $data_GI,
                        'tipe'      => $tipe,
                        'jumlah'      => $jumlah,
                        'total'      => $total,
                    ]);

                });

            })
            ->download('xls');
            
                return view('admin.nonmaster.excel.deviasi',[
                    'area'      => 'null',
                    'data_GI'   => null,
                    'tipe'      => $tipe,
                    'jumlah'      => null,
                    'rayon'     => $org->nama_organisasi,
                ]);
            }
        }
    }

    public function excel_beli($id_rayon,$tipe,$id,$tr){
        $cmb = new MasterLaporan($id_rayon,$tipe,$id);
        $gi = GI::where('id',$id)->first();
        $areas = Organisasi::where('id',$gi->id_organisasi)->first();
        $id_org = substr($areas->id_organisasi, 0, 3) . "%%";
        $area = Organisasi::where('id_organisasi', 'like', $id_org)->where('tipe_organisasi', 2)->first();

        $penyulang_array =$this->data_penyulang($cmb->trafo);
        $list_array = $this->total_pemakaian_energi($cmb->id, $penyulang_array);

        $trafo_GI = $this->data_trafo($cmb->id,$list_array);


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

        $sum =0; $sum_ =0;
        for ($j=0; $j < count($penyulang_array); $j++){
            if($penyulang_array[$j]['id_trafo']== $cmb->trafo[0]->id){
                $sum +=(json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual'])+(json_decode($penyulang_array[$j]['data'],true)['hasil_pengolahan']['download']['total_pemakaian_kwh_download']);
                $sum_ +=(json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['utama']['download']['total_pemakaian_kwh_download']-json_decode($cmb->p_trafo_[0]->data,true)['hasil_pengolahan']['ps']['visual']['total_pemakaian_kwh_visual'])
                /($list_array[0]['total_pemakaian_energi_'])*(json_decode($penyulang_array[$j]['data_'],true)['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']);
            }
        }

        $nama_organisasi = $area->nama_organisasi;

        Excel::create('laporan GI', function($excel)use($cmb,$penyulang_array,$list_array,$list_data_trafo,$trafo_GI,$deviasi,$sum,$arr_sum_,$gi,$nama_organisasi,$tr){

                $excel->sheet($trafo_GI[$tr]['nama'], function($sheet) use($cmb,$penyulang_array,$list_array,$list_data_trafo,$trafo_GI,$deviasi,$sum,$arr_sum_,$gi,$nama_organisasi,$tr) {

                    $sheet->mergeCells('A8:B10');
                    $sheet->mergeCells('C8:D9');
                    $sheet->mergeCells('E8:F9');
                    $sheet->mergeCells('H8:I9');
                    $sheet->getStyle('C8')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('E8')->getAlignment()->setWrapText(true);
                    $sheet->getStyle('G8')->getAlignment()->setWrapText(true);

                    $sheet->setPageMargin(0.25);
                    $sheet->setOrientation('landscape');
                    $sheet->loadView('admin.nonmaster.excel.excelGI',[
                        'data'      => $cmb,
                        'penyulang' => $penyulang_array,
                        'pemakaian' => $list_array,
                        'dt_trafo' => $list_data_trafo,
                        'data_master' => $trafo_GI,
                        'deviasi' => $deviasi,
                        'sum'       => $sum,
                        'sum_'       => $arr_sum_,
                        'gi'        => $gi,
                        'area'      => $nama_organisasi,
                        'tr'        => $tr
                    ]);

                });

            })
            ->download('xls');


        return view('admin.nonmaster.excel.excelGI',[
            'data'      => $cmb,
            'penyulang' => $penyulang_array,
            'pemakaian' => $list_array,
            'dt_trafo' => $list_data_trafo,
            'data_master' => $trafo_GI,
            'deviasi' => $deviasi,
            'sum'       => $sum,
            'sum_'       => $arr_sum_,
            'gi'        => $gi,
            'area'      => $area->nama_organisasi,
            'tr'        => $tr
        ]);

        
    }

    public function view_beli_tsa_trafo_gi($id_organisasi, $id_gi) {
        return view('admin.nonmaster.laporan.tsa_trafo_gi');
    }

    public function view_beli_tsa_rayon($id_organisasi, $tsa, $tipe) {

        $data_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get()->toArray();
        $id_org = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id')->toArray();
        $gi = GI::whereIn('id_organisasi',$id_org)->get()->toArray();

        $arr_rayon = array();
        for($i=0;$i<count($id_org);$i++){
            $arr_gi = array();
            for($j=0;$j<count($gi);$j++){
                if($data_org[$i]['id']==$gi[$j]['id_organisasi'])
                    array_push($arr_gi,$gi[$j]);
            }
            array_push($arr_rayon,$arr_gi);
        }



        return view('admin.nonmaster.laporan.tsa_rayon',[
        ]);
    }

    public function view_beli_tsa_area($id_organisasi) {
        return view('admin.nonmaster.laporan.tsa_area');
    }

    public function data_pct($id_rayon,$p_penyulang ,$p_gardu,$gardu,$nama_rayon){
        $dp_gardu = array();
        $idrayon = $id_rayon->toArray();

        //        Stand Expor Impor
        for($i=0;$i<count($p_gardu);$i++){
            for($j=0;$j<count($gardu);$j++) {
                if(in_array($gardu[$j]['id_organisasi'],$idrayon)) $tipe = true;
                else $tipe=false;
                if($p_gardu[$i]['id_gardu']==$gardu[$j]['id']){
                    $data = array(
                        'tipe' => $tipe,
                        'nama_gardu' => $gardu[$j]['nama_gardu'],
                        'id_gardu' => $gardu[$j]['id'],
                        'id_penyulang' => $gardu[$j]['id_penyulang'],
                        'id_rayon' => $gardu[$j]['id_organisasi'],
                        'rincian' => $gardu[$j]['rincian'],
                        'tujuan' => $gardu[$j]['tujuan'],
                        'data_master'=> $gardu[$j]['data_master'],
                        'data'=> $p_gardu[$i]['data'],
                        'data_keluar'=> $p_gardu[$i]['data_keluar'],
                    );
                    array_push($dp_gardu,$data);
                    break;
                }
            }
        }
        $total_ekspor = $total_impor = null;
        for($i=0;$i<count($dp_gardu);$i++){
            if($dp_gardu[$i]['tipe']) {
                if (json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_download'] == 0)
                    $total_impor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_visual'];
                else  $total_impor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_download'];
                if (json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_download'] == 0)
                    $total_ekspor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_visual'];
                else $total_ekspor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_download'];
            }
            else {
                if (json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_download'] == 0)
                    $total_ekspor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_visual'];
                else  $total_ekspor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['impor']['total_kwh_download'];
                if (json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_download'] == 0)
                    $total_impor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_visual'];
                else $total_impor += json_decode($dp_gardu[$i]['data'], true)['hasil_pengolahan']['ekspor']['total_kwh_download'];
            }
        }
        $wbp_e =$lwbp1_e =$lwbp2_e=$kvar_e=$kh_e =$wbp_i =$lwbp1_i =$lwbp2_i=$kvar_i=$kh_i = null;
        $hasil_e =$hasil_i = null;

        //        Data Urai
        $data_urai = array();
        for($i=0;$i<count($dp_gardu);$i++) {
            for($j=0;$j<count($p_penyulang);$j++){
                if($dp_gardu[$i]['tipe']){
                    if(json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)
                        $hasil_i =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual'];
                    else  $hasil_i =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download'];

                    if(json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)
                        $hasil_e =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual'];
                    else $hasil_e =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download'];
                }
                else{
                    if(json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download']==0)
                        $hasil_e =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_visual'];
                    else  $hasil_e =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['impor']['total_kwh_download'];
                    if(json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download']==0)
                        $hasil_i =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_visual'];
                    else $hasil_i =json_decode($dp_gardu[$i]['data'],true)['hasil_pengolahan']['ekspor']['total_kwh_download'];
                }
                $total = json_decode($p_penyulang[$j]['data_keluar'],true)['total_kwh'];
                if($total ==0) $total =1;
                if($dp_gardu[$i]['id_penyulang'] ==$p_penyulang[$j]['id_penyulang']){
                    $wbp_e = intval(($hasil_e*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_wbp']/$total))/1+0.5);
                    $lwbp1_e = intval(($hasil_e*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_lwbp1']/$total))/1+0.5);
                    $lwbp2_e = intval(($hasil_e*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_lwbp2']/$total))/1+0.5);
                    $kvar_e = intval(($hasil_e*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_kvar']/$total))/1+0.5);
                    $kw_e = intval(($hasil_e*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_kw']/$total))/1+0.5);

                    $wbp_i = intval(($hasil_i*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_wbp']/$total))/1+0.5);
                    $lwbp1_i = intval(($hasil_i*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_lwbp1']/$total))/1+0.5);
                    $lwbp2_i = intval(($hasil_i*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_lwbp2']/$total))/1+0.5);
                    $kvar_i = intval(($hasil_i*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_kvar']/$total))/1+0.5);
                    $kw_i = intval(($hasil_i*(json_decode($p_penyulang[$j]['data_keluar'],true)['dev_kw']/$total))/1+0.5);
                    $dt_urai = array(
                        'id_rayon' => $dp_gardu[$i]['id_rayon'],
                        'id_penyulang' => $p_penyulang[$j]['id_penyulang'],
                        'pct' => $dp_gardu[$i]['nama_gardu'],
                        'rincian' => $dp_gardu[$i]['rincian'],
                        'id_pct' => $dp_gardu[$i]['id_gardu'],
                        'lwbp1_e' => $lwbp1_e,
                        'lwbp2_e' => $lwbp2_e,
                        'wbp_e' => $wbp_e,
                        'kvar_e' => $kvar_e,
                        'kw_e' => $kw_e,
                        'lwbp1_i' => $lwbp1_i,
                        'lwbp2_i' => $lwbp2_i,
                        'wbp_i' => $wbp_i,
                        'kvar_i' => $kvar_i,
                        'kw_i' => $kw_i,
                    );
                    array_push($data_urai,$dt_urai);
                    break;

                }
            }
        }

        //        Rayon
        $rayon = array();
        for($i=0;$i<count($nama_rayon);$i++) {
            $total_lwbp1_e =$total_lwbp2_e =$total_wbp_e =$total_lwbp1_i =$total_lwbp2_i =$total_wbp_i = $total_kvar_e =$total_kw_e =$total_kvar_i =$total_kw_i =null;
            for($j=0;$j<count($data_urai);$j++) {
                if($data_urai[$j]['id_rayon']==$id_rayon[$i]){
                    $total_lwbp1_e +=$data_urai[$j]['lwbp1_e'];
                    $total_lwbp2_e +=$data_urai[$j]['lwbp2_e'];
                    $total_wbp_e +=$data_urai[$j]['wbp_e'];
                    $total_kvar_e +=$data_urai[$j]['kvar_e'];
                    $total_kw_e +=$data_urai[$j]['kw_e'];
                    $total_lwbp1_i +=$data_urai[$j]['lwbp1_i'];
                    $total_lwbp2_i +=$data_urai[$j]['lwbp2_i'];
                    $total_wbp_i +=$data_urai[$j]['wbp_i'];
                    $total_kvar_i +=$data_urai[$j]['kvar_i'];
                    $total_kw_i +=$data_urai[$j]['kw_i'];
                }
            }
            $data_rayon = array(
                'id_rayon' => $id_rayon[$i],
                'nama_rayon' => $nama_rayon[$i],
                'nama_rayon' => $nama_rayon[$i],
                'lwbp1_e' => $lwbp1_e,
                'lwbp2_e' => $total_lwbp2_e,
                'wbp_e' => $total_wbp_e,
                'kvar_e' => $total_kvar_e,
                'kw_e' => $total_kw_e,
                'lwbp1_i' => $total_lwbp1_i,
                'lwbp2_i' => $total_lwbp2_i,
                'wbp_i' => $total_wbp_i,
                'kvar_i' => $total_kvar_i,
                'kw_i' => $total_kw_i,
            );
            array_push($rayon,$data_rayon);
        }
//        dd($rayon);

        return array($gardu,$dp_gardu,$total_impor,$total_ekspor,$data_urai,$rayon);
    }

    public function view_beli_pct($id_organisasi, $tipe, $id) {
        $id_rayon = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('id');
        $nama_rayon = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->pluck('nama_organisasi');
        $cmb = new MasterLaporan($id_rayon,$tipe,$id);
        $gardu    = $cmb->gardu;$p_penyulang    = $cmb  ->p_penyulang;   $p_gardu  = $cmb->p_gardu;
        $data = $this->data_pct($id_rayon,$p_penyulang,$p_gardu,$gardu,$nama_rayon);
        return view('admin.nonmaster.laporan.pct',[
            'gardu'      => $data[0],
            'p_gardu'   => $data[1],
            'total_i'   => $data[2],
            'total_e'   => $data[3],
            'dt_urai'   => $data[4],
            'dt_rayon'   => $data[5],
        ]);
    }
}
