<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\GI;
use App\Organisasi;
use App\PenyimpananGardu;
use App\PenyimpananGI;
use App\PenyimpananPenyulang;
use App\PenyimpananTrafoGI;
use App\Penyulang;
use App\TrafoGI;
use Illuminate\Http\Request;
//use App\Listrik;
use Auth;

class Input extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
//        $rayon = Organisasi::where('id_organisasi', Auth::user()->id_organisasi)->get();
//        $id_org = $rayon[0]->id;
//        $data = GI::where('id_organisasi', $id_org)->get();
//        return view('admin.nonmaster.dashboard_user.list_gardu_induk',[
//            'data' =>$data
//        ]);
        return $this->list_gardu_induk(Auth::user()->id_organisasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($tipe)
    {
//        $data_listrik = Listrik::where('tahun_bulan', date('Ym'))->where('id_organisasi', Auth::user()->id_organisasi)->first();
//        $data = json_decode($data_listrik->data, true);
//
//        return view('admin.nonmaster.dashboard_user.input_data', [
//            'tipe' => $tipe] , [
//            'data' => $data
//            ] );
    }

    public function list_gardu_induk($id_rayon){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $id_org = $rayon[0]->id;
        $data = GI::where('id_organisasi', $id_org)->get();
        return view('admin.nonmaster.dashboard_user.list_input_gardu_induk',[
            'data' =>$data
        ]);
    }

    public function list_trafo_gi($id_gi){
        $gi = GI::where('id', $id_gi)->first();
        $data = TrafoGI::where('id_gi', $id_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_input_trafo_gi',[
            'data' =>$data,
            'gardu' =>$gi
        ]);
    }

    public function list_penyulang($id_trafo_gi){
        $t_gi = TrafoGI::where('id', $id_trafo_gi)->first();
        $data = Penyulang::where('id_trafo_gi', $id_trafo_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_input_penyulang',[
            'data' =>$data,
            't_gi' =>$t_gi
        ]);
    }

    public function list_gd($id_gi){
        $penyulang = Penyulang::where('id', $id_gi)->first();
        $data = Gardu::where('id_penyulang', $id_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_input_gd',[
            'data' =>$data,
            'penyulang' =>$penyulang
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */


    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    public function store(Request $request)
    {
        $date = date('Ym')- "1";
        $input_visual = array(
            'lwbp1_visual' => $request->lwbp1_visual,
            'lwbp2_visual' => $request->lwbp2_visual,
            'wbp_visual' => $request->wbp_visual,
            'kvarh_visual' => $request->kvarh_visual
        );

        $input_download = array(
            'lwbp1_download' => $request->lwbp1_download,
            'lwbp2_download' => $request->lwbp2_download,
            'wbp_download' => $request->wbp_download,
            'kvarh_download' => $request->kvarh_download
        );

        if($request->tipe=="gi"){
            $data_listrik = PenyimpananGI::where('periode', date('Ym'))->where('id_gi', $request->id)->first();
        }
        elseif($request->tipe=="trafo_gi"){
            $data_listrik = PenyimpananTrafoGI::where('periode', date('Ym'))->where('id_trafo_gi', $request->id)->first();
        }
        elseif($request->tipe=="penyulang"){
            $data_listrik = PenyimpananPenyulang::where('periode', date('Ym'))->where('id_penyulang', $request->id)->first();
        }
        elseif($request->tipe=="gardu"){
            $data_listrik = PenyimpananGardu::where('periode', date('Ym'))->where('id_gardu', $request->id)->first();
        }

        if($data_listrik){
            $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter);
            $data_listrik->data = json_encode($data);
            if ($data_listrik->save()) ;
            return back();
        }
        else {
            $data = array(
                'visual' => $input_visual,
                'download' => $input_download
            );

            if($request->tipe=="trafo_gi"){
                $visual = array(
                    'lwbp1_visual' => null,
                    'lwbp2_visual' => null,
                    'wbp_visual' => null,
                    'kvarh_visual' => null,
                );

                $download = array(
                    'lwbp1_download' => null,
                    'lwbp2_download' => null,
                    'wbp_download' => null,
                    'kvarh_download' => null,
                );
                $data2 = array(
                    'visual' => $visual,
                    'download' => $download
                );

                if($request->meter=="utama") {
                    $data1 = array(
                        'utama' => $data,
                        'pembanding' => $data2,
                        'ps' => $data2
                    );
                }
                elseif($request->meter=="pembanding") {
                    $data1 = array(
                        'utama' => $data2,
                        'pembanding' => $data,
                        'ps' => $data2
                    );
                }
                elseif($request->meter=="ps") {
                    $data1 = array(
                        'utama' => $data2,
                        'pembanding' => $data2,
                        'ps' =>  $data,
                    );
                }
//                dd($data1);
                $dt = array(
                    'beli' => $data1,
                    'hasil_pengolahan' => null
                );
            }
            else{
                $dt = array(
                    'beli' => $data,
                    'hasil_pengolahan' => null
                );

            }

            if ($request->tipe == "gi") {
                $P = new PenyimpananGI();
                $P->id_gi = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananGI::where('periode', $date)->where('id_gi', $request->id)->first();
            }
            elseif ($request->tipe == "trafo_gi") {
                $P = new PenyimpananTrafoGI();
                $P->id_trafo_gi = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananTrafoGI::where('periode', $date)->where('id_trafo_gi', $request->id)->first();
            } elseif ($request->tipe == "penyulang") {
                $P = new PenyimpananPenyulang();
                $P->id_penyulang= $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananPenyulang::where('periode', $date)->where('id_penyulang', $request->id)->first();
            } elseif ($request->tipe == "gardu") {
                $P = new PenyimpananGardu();
                $P->id_gardu = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananPenyulang::where('periode', $date)->where('id_gardu', $request->id)->first();
            }

            if($data_awal){
                $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter);
                $P->data = json_encode($data);
                if ($P->save());
            }
            else {
                if($P->save());
            }

            return back();

        }
    }

    public function olah_data($visual,$download,$id,$tipe,$meter){
        $date = date('Ym')- "1";
        $date_ = date('Ym');
        $boolean = true;

        if($tipe=="gi"){
            $awal = PenyimpananGI::where('periode', $date)->where('id_gi', $id)->first();
            $data_master = GI::where('id', $id)->first();
            $akhir = PenyimpananGI::where('periode', $date_)->where('id_gi', $id)->first();
        }
        elseif($tipe=="trafo_gi"){
            $awal = PenyimpananTrafoGI::where('periode', $date)->where('id_trafo_gi', $id)->first();
            $data_master = TrafoGI::where('id', $id)->first();
            $akhir = PenyimpananTrafoGI::where('periode', $date_)->where('id_trafo_gi', $id)->first();
        }
        elseif($tipe=="penyulang"){
            $awal = PenyimpananPenyulang::where('periode', $date)->where('id_penyulang', $id)->first();
            $data_master = Penyulang::where('id', $id)->first();
            $akhir = PenyimpananPenyulang::where('periode', $date_)->where('id_penyulang', $id)->first();
        }
        elseif($tipe=="gardu"){
            $awal = PenyimpananGardu::where('periode', $date)->where('id_gardu', $id)->first();
            $data_master = Gardu::where('id', $id)->first();
            $akhir = PenyimpananGardu::where('periode', $date_)->where('id_gardu', $id)->first();
        }
        $data_master = json_decode($data_master->data_master, true);

        if($tipe=="trafo_gi")
            $faktor_kali = (int)$data_master[$meter]['FK']['faktorkali'];
        else
            $faktor_kali = (int)$data_master['FK']['faktorkali'];

        $data_master = array(
            'visual' => $visual,
            'download' => $download
        );

//        if($awal){
//            $visual = $this->json_datamaster($data_master, $akhir, "visual", $tipe,$meter, $faktor_kali);
//            $download = $this->json_datamaster($data_master, $akhir, "download", $tipe,$meter, $faktor_kali);
//        }else{
//            $visual = $this->json_datamaster($data_master, $awal, "visual", $tipe,$meter, $faktor_kali);
//            $download = $this->json_datamaster($data_master, $awal, "download", $tipe,$meter, $faktor_kali);
//        }
//
//        $data_master2 = array(
//            'visual' => $visual,
//            'download' => $download
//        );
////        dd($data_master2);
        $da="";
        $data="";
        $hasil="";

//        if($awal){
////            $da = json_decode($akhir->data, true);
//            if($tipe=="trafo_gi"){
//                if($meter=="utama"){
////                    $utama = $da['beli']['utama'];
////                    $pembanding = $da['beli']['pembanding'];
////                    $ps = $da['beli']['ps'];
////                    $pembanding2 = array(
////                        'visual' => $this->json_datamaster($da['beli']['pembanding'], $awal, "visual", $tipe,"pembanding", $faktor_kali),
////                        'download' => $this->json_datamaster($da['beli']['pembanding'], $awal, "download", $tipe,"pembanding", $faktor_kali)
////                    );
////                    $ps2 = array(
////                        'visual' => $this->json_datamaster($da['beli']['ps'], $awal, "visual", $tipe,"ps", $faktor_kali),
////                        'download' => $this->json_datamaster($da['beli']['ps'], $awal, "download", $tipe,"ps", $faktor_kali)
////                    );
//                    $pembanding = array(
//                        'visual' => $this->json_datamaster($da['beli']['pembanding'], $awal, "visual", $tipe,"pembanding", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['pembanding'], $awal, "download", $tipe,"pembanding", $faktor_kali)
//                    );
//                    $ps = array(
//                        'visual' => $this->json_datamaster($da['beli']['ps'], $awal, "visual", $tipe,"ps", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['ps'], $awal, "download", $tipe,"ps", $faktor_kali)
//                    );
//                    $data  = array(
//                        'utama' => $data_master,
//                        'pembanding' => $pembanding,
//                        'ps' =>$ps
//                    );
////                    $hasil  = array(
////                        'utama' => $data_master,
////                        'pembanding' => $pembanding2,
////                        'ps' =>$ps2
////                    );
//                }
//                elseif($meter=="pembanding"){
//                    $utama = array(
//                        'visual' => $this->json_datamaster($da['beli']['utama'], $awal, "visual", $tipe,"utama", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['utama'], $awal, "download", $tipe,"utama", $faktor_kali)
//                    );
//                    $ps = array(
//                        'visual' => $this->json_datamaster($da['beli']['ps'], $awal, "visual", $tipe,"ps", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['ps'], $awal, "download", $tipe,"ps", $faktor_kali)
//                    );
//                    $data  = array(
//                        'utama' => $utama,
//                        'pembanding' => $data_master,
//                        'ps' =>$ps
//                    );
//                }
//                elseif($meter=="ps"){
//                    $utama = array(
//                        'visual' => $this->json_datamaster($da['beli']['utama'], $awal, "visual", $tipe,"utama", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['utama'], $awal, "download", $tipe,"utama", $faktor_kali)
//                    );
//                    $pembanding = array(
//                        'visual' => $this->json_datamaster($da['beli']['pembanding'], $awal, "visual", $tipe,"pembanding", $faktor_kali),
//                        'download' => $this->json_datamaster($da['beli']['pembanding'], $awal, "download", $tipe,"pembanding", $faktor_kali)
//                    );
//                    $data  = array(
//                        'utama' => $utama,
//                        'pembanding' => $pembanding,
//                        'ps' =>$data_master
//                    );
//                }
//
//
//            }
//            else{
//                $data = $data_master;
//            }
//
//
//        }
//        else{
//            $akhir=$akhir->data;
////            dd($akhir);
//            $visual = $this->json_datamaster($data_master, $awal, "visual", $tipe,$meter, $faktor_kali);
//            $download = $this->json_datamaster($data_master, $awal, "download", $tipe,$meter, $faktor_kali);
//            $data_master = array(
//                'visual'=> $visual,
//                'download'=> $download
//            );
//            if($tipe=="trafo_gi"){
//                if($meter=="utama"){
//                    $pembanding = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//                    $ps = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//
//                    $data  = array(
//                        'utama' => $data_master,
//                        'pembanding' => $pembanding,
//                        'ps' =>$ps
//                    );
//
////                    dd($data);
//                }
//                elseif($meter=="pembanding"){
//                    $utama = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//                    $ps = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//                    $data  = array(
//                        'utama' => $utama,
//                        'pembanding' => $data_master,
//                        'ps' =>$ps
//                    );
//                }
//                elseif($meter=="ps"){
//                    $utama = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//                    $pembanding = array(
//                        'visual' => $this->json_datamaster($akhir, $awal, "visual", $tipe,$meter, $faktor_kali),
//                        'download' => $this->json_datamaster($akhir, $awal, "download", $tipe,$meter, $faktor_kali)
//                    );
//                    $data  = array(
//                        'utama' => $utama,
//                        'pembanding' => $pembanding,
//                        'ps' =>$data_master
//                    );
//                }
//            }
//            else{
//                $data = $data_master;
//            }
//        }
//
//        if($awal && $akhir);
//        else $hasil ="";
//
//        $dt = array(
//            'beli' => $data,
//            'hasil_pengolahan' => $hasil
//        );
//        dd($dt);
        if($tipe=="trafo_gi"){
            $diff =$this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali);
            $dt = array(
                'beli'=> $diff[0],
                'hasil_pengolahan'=> $diff[1]
            );
            $update = $dt['beli'];
            $olah = $dt['hasil_pengolahan'];
            if(!$akhir){
                $diff =$this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali);
                $dt = array(
                    'beli'=> $diff[0],
                    'hasil_pengolahan'=> $diff[1]
                );
                if($meter=="utama"){
                    $dt = array(
                        'utama'=>$update,
                        'pembanding'=> null,
                        'ps'=>null
                    );
                    $dt2 = array(
                        'utama'=>$olah,
                        'pembanding'=> null,
                        'ps'=>null
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }
                elseif($meter=="pembanding"){
                    $dt = array(
                        'utama'=>null,
                        'pembanding'=>$update,
                        'ps'=>null
                    );
                    $dt2 = array(
                        'utama'=>null,
                        'pembanding'=>$olah,
                        'ps'=>null
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }
                elseif($meter=="ps"){
                    $dt = array(
                        'utama'=>null,
                        'pembanding'=>null,
                        'ps'=>$update
                    );
                    $dt2 = array(
                        'utama'=>null,
                        'pembanding'=>null,
                        'ps'=>$olah
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }
            }
            else{
                $akhir = json_decode($akhir->data,true);
                if($meter=="utama"){
                    $dt = array(
                        'utama'=>$update,
                        'pembanding'=> $akhir['beli']['pembanding'],
                        'ps'=>$akhir['beli']['ps']
                    );
                    $dt2 = array(
                        'utama'=>$olah,
                        'pembanding'=> $akhir['hasil_pengolahan']['pembanding'],
                        'ps'=>$akhir['hasil_pengolahan']['ps']
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );

                }
                elseif($meter=="pembanding"){
                    $dt = array(
                        'utama'=>$akhir['beli']['utama'],
                        'pembanding'=>$update,
                        'ps'=>$akhir['beli']['ps']
                    );
                    $dt2 = array(
                        'utama'=>$akhir['hasil_pengolahan']['utama'],
                        'pembanding'=>$olah,
                        'ps'=>$akhir['hasil_pengolahan']['ps']
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );

                }
                elseif($meter=="ps"){
                    $dt = array(
                        'utama'=>$akhir['beli']['utama'],
                        'pembanding'=>$akhir['beli']['pembanding'],
                        'ps'=>$update
                    );
                    $dt2 = array(
                        'utama'=>$akhir['hasil_pengolahan']['utama'],
                        'pembanding'=>$akhir['hasil_pengolahan']['pembanding'],
                        'ps'=>$olah
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }

            }
                   }
        else{
            $dt = $this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali);
        }
//                dd($dt);

        return $dt;
    }

    public function json_dt($data_awal,$visual,$download,$tipe,$meter,$faktor_kali )
    {
        if($data_awal){
            $boolean = true;
            $data_awal = json_decode($data_awal->data, true);
        }else{
            $boolean = false;
        }

        $lwbp1_visual = $visual['lwbp1_visual'];
        $lwbp2_visual = $visual['lwbp2_visual'];
        $wbp_visual = $visual['wbp_visual'];
        $kvarh_visual = $visual['kvarh_visual'];

        $data_visual = array(
            'lwbp1_visual' => $lwbp1_visual,
            'lwbp2_visual' => $lwbp2_visual,
            'wbp_visual' => $wbp_visual,
            'kvarh_visual' => $kvarh_visual,
        );

        if($boolean){
            if($tipe=="trafo_gi"){
                $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli'][$meter]['visual']['lwbp1_visual'])*$faktor_kali;
                $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli'][$meter]['visual']['lwbp2_visual'])*$faktor_kali;
                $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli'][$meter]['visual']['wbp_visual'])*$faktor_kali;
                $kvarh_visual = ($data_visual['kvarh_visual'] - $data_awal['beli'][$meter]['visual']['kvarh_visual'])*$faktor_kali;
            }
            else{
                $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli']['visual']['lwbp1_visual'])*$faktor_kali;
                $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli']['visual']['lwbp2_visual'])*$faktor_kali;
                $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli']['visual']['wbp_visual'])*$faktor_kali;
                $kvarh_visual = ($data_visual['kvarh_visual'] - $data_awal['beli']['visual']['kvarh_visual'])*$faktor_kali;
            }
        }

        $data_visual2 = array(
            'lwbp1_visual' => $lwbp1_visual,
            'lwbp2_visual' => $lwbp2_visual,
            'wbp_visual' => $wbp_visual,
            'kvarh_visual' => $kvarh_visual,
            'total_pemakaian_kwh_visual' => $lwbp1_visual + $lwbp2_visual + $wbp_visual
        );

        $lwbp1_download = $download['lwbp1_download'];
        $lwbp2_download = $download['lwbp2_download'];
        $wbp_download =  $download['wbp_download'];
        $kvarh_download = $download['kvarh_download'];

        $data_download = array(
            'lwbp1_download' => $lwbp1_download,
            'lwbp2_download' => $lwbp2_download,
            'wbp_download' => $wbp_download,
            'kvarh_download' => $kvarh_download,
        );

        if($boolean){
            if($tipe=="trafo_gi"){
                $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli'][$meter]['download']['lwbp1_download'])*$faktor_kali;
                $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli'][$meter]['download']['lwbp2_download'])*$faktor_kali;
                $wbp_download =  ($download['wbp_download'] - $data_awal['beli'][$meter]['download']['wbp_download'])*$faktor_kali;
                $kvarh_download = ($download['kvarh_download'] - $data_awal['beli'][$meter]['download']['kvarh_download'])*$faktor_kali;
            }else{
                $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli']['download']['lwbp1_download'])*$faktor_kali;
                $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli']['download']['lwbp2_download'])*$faktor_kali;
                $wbp_download =  ($download['wbp_download'] - $data_awal['beli']['download']['wbp_download'])*$faktor_kali;
                $kvarh_download = ($download['kvarh_download'] - $data_awal['beli']['download']['kvarh_download'])*$faktor_kali;
            }
        }

        $data_download2 = array(
            'lwbp1_download' => $lwbp1_download,
            'lwbp2_download' => $lwbp2_download,
            'wbp_download' => $wbp_download,
            'kvarh_download' => $kvarh_download,
            'total_pemakaian_kwh_download' => $lwbp1_download + $lwbp2_download + $wbp_download

        );

        $data = array(
            'visual' => $data_visual,
            'download' => $data_download );

        if($boolean) {
            $data_pengolahan = array(
                'visual' => $data_visual2,
                'download' => $data_download2
            );
        }
        else{
            $data_pengolahan = "";
        }

        $dt = array(
            'beli' => $data,
            'hasil_pengolahan' => $data_pengolahan
        );

        return array ($data, $data_pengolahan);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        echo $request;
//        $data_listrik = Listrik::find($id);
//        $dt = array(
//                'jual' => null,
//                'beli' => null );
//
//        if(!isset($data_listrik->data)){
//            $data_visual = array(
//                'lwbp1_visual' => null,
//                'lwbp2_visual' => null,
//                'wbp_visual' => null,
//                'kvarh_visual' => null
//             );
//
//            $data_download = array(
//                'lwbp1_download' => null,
//                'lwbp2_download' => null,
//                'wbp_download' => null,
//                'kvarh_download' => null
//            );
//
//            $data = array(
//                'visual' => $data_visual,
//                'download' => $data_download );
//
//            $dt = array(
//                'jual' => $data,
//                'beli' => $data );
//
//            $data_visual = array(
//                'lwbp1_visual' => $request->lwbp1_visual,
//                'lwbp2_visual' => $request->lwbp2_visual,
//                'wbp_visual' => $request->wbp_visual,
//                'kvarh_visual' => $request->kvarh_visual
//             );
//
//            $data_download = array(
//                'lwbp1_download' => $request->lwbp1_download,
//                'lwbp2_download' => $request->lwbp2_download,
//                'wbp_download' => $request->wbp_download,
//                'kvarh_download' => $request->kvarh_download
//            );
//
//            $data = array(
//                'visual' => $data_visual,
//                'download' => $data_download );
//
//            if($request->tipe == 'jual'){
//                $dt['jual'] = $data;
//            }else if($request->tipe == 'beli'){
//                $dt['beli'] = $data;
//            }
//
//            $listrik = new Listrik;
//            $listrik->id_organisasi = Auth::user()->id_organisasi;
//            $listrik->tahun_bulan = date('Ym');
//            $listrik->tipe_listrik = Auth::user()->tipe_organisasi;
//            $listrik->data = json_encode($dt);
//            if($listrik->save())
//                echo "berhasil";
//            else
//                echo "gagal";
//        }else {
//            $dt = (array) json_decode($data_listrik->data);
//
//            $data_visual = array(
//                'lwbp1_visual' => $request->lwbp1_visual,
//                'lwbp2_visual' => $request->lwbp2_visual,
//                'wbp_visual' => $request->wbp_visual,
//                'kvarh_visual' => $request->kvarh_visual
//             );
//
//            $data_download = array(
//                'lwbp1_download' => $request->lwbp1_download,
//                'lwbp2_download' => $request->lwbp2_download,
//                'wbp_download' => $request->wbp_download,
//                'kvarh_download' => $request->kvarh_download
//            );
//
//            $data = array(
//                'visual' => $data_visual,
//                'download' => $data_download );
//
//            if($request->tipe == 'jual'){
//                $dt['jual'] = $data;
//            }else if($request->tipe == 'beli'){
//                $dt['beli'] = $data;
//            }
//
//            $listrik = Listrik::find($id);
//            $listrik->id_organisasi = Auth::user()->id_organisasi;
//            $listrik->tahun_bulan = "201702";
//            $listrik->tipe_listrik = Auth::user()->tipe_organisasi;
//            $listrik->data = json_encode($dt);
//            if($listrik->save())
//                echo "berhasil";
//            else
//                echo "gagal";
//        }

//        return redirect(route('listrik.list_data'))->with('status', [
//            'enabled'       => true,
//            'type'          => 'success',
//            'content'       => 'Berhasil login!'
//            ]);
//        $data = Listrik::where('id_organisasi', Auth::user()->id_organisasi)->get();
//        return view('admin.nonmaster.listrik.hasil_pengolahan', [
//            'data'            => $data
//        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function list_data(){
        $data = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->get();
        return view('admin.nonmaster.dashboard_user.list_gardu_laporan',[
            'data' =>$data
        ]);
    }

    public function list_laporan_gardu($id_gardu){
        $data = PenyimpananGI::where('id_gi', $id_gardu)->get();
        return view('admin.nonmaster.listrik.hasil_pengolahan', [
            'data'            => $data
        ]);
    }

    public function input_data($id,$tipe){

        if($tipe=="gi"){
            $data = PenyimpananGI::where('periode',date('Ym'))->where('id_gi', $id)->first();
            $jenis = GI::where('id',$id)->first();
        }
        elseif($tipe=="trafo_gi"){
            $data = PenyimpananTrafoGI::where('periode',date('Ym'))->where('id_trafo_gi', $id)->first();
            $jenis = TrafoGI::where('id',$id)->first();
        }
        elseif($tipe=="penyulang"){
            $data = PenyimpananPenyulang::where('periode',date('Ym'))->where('id_penyulang', $id)->first();
            $jenis = Penyulang::where('id',$id)->first();
        }
        elseif($tipe=="gardu"){
            $data = PenyimpananGardu::where('periode',date('Ym'))->where('id_gardu', $id)->first();
            $jenis = Gardu::where('id',$id)->first();
        }

        if($data){
            $data = json_decode($data->data, true);
        }
        else {

            $data_visual = array(
                'lwbp1_visual' => null,
                'lwbp2_visual' => null,
                'wbp_visual' => null,
                'kvarh_visual' => null
            );

            $data_download = array(
                'lwbp1_download' => null,
                'lwbp2_download' => null,
                'wbp_download' => null,
                'kvarh_download' => null
            );

            $data_awal = array(
                'visual' => $data_visual,
                'download' => $data_download );

            if($tipe=="trafo_gi"){
                $data_awal = array(
                    'utama' => $data_awal,
                    'pembanding' => $data_awal,
                    'ps' => $data_awal,
                );
            }
            $data =array(
                'beli'=>$data_awal,
                'hasil_pengolahan'=> null
            );

            $hasil = json_encode($data);
            $data = json_decode($hasil, true);
        }

        return view('admin.nonmaster.dashboard_user.input_data', [
            'data'            => $data,
            'jenis'           => $jenis,
            'tipe'            => $tipe
        ]);
    }

    public function input_data_keluar($id,$tipe){

        if($tipe=="gi"){
            $data = PenyimpananGI::where('periode',date('Ym'))->where('id_gi', $id)->first();
            $jenis = GI::where('id',$id)->first();
        }
        else{
            $data = PenyimpananTrafoGI::where('periode',date('Ym'))->where('id_trafo_gi', $id)->first();
            $jenis = TrafoGI::where('id',$id)->first();
        }

        if($data){
            $data = json_decode($data->data, true);
        }
        else {
            $data_visual = array(
                'lwbp1_visual' => null,
                'lwbp2_visual' => null,
                'wbp_visual' => null,
                'kvarh_visual' => null
            );

            $data_download = array(
                'lwbp1_download' => null,
                'lwbp2_download' => null,
                'wbp_download' => null,
                'kvarh_download' => null
            );

            $data_awal = array(
                'visual' => $data_visual,
                'download' => $data_download );

            $data =array(
                'beli'=>$data_awal,
                'hasil_pengolahan'=> null
            );
            $hasil = json_encode($data);

            $data = json_decode($hasil, true);
        }

//        dd($data);
        return view('admin.nonmaster.dashboard_user.input_data_dummy1', [
            'data'            => $data,
            'jenis'           => $jenis,
            'tipe'            => $tipe
        ]);
    }



}