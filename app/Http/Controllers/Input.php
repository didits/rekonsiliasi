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
        return view('admin.nonmaster.dashboard_user.list_input',[
            'data' => $data,
            'gi' =>$gi, 't_gi' => null, 'penyulang' => null
        ]);
    }

    public function list_penyulang($id_trafo_gi){
        $t_gi = TrafoGI::where('id', $id_trafo_gi)->first();
        $data = Penyulang::where('id_trafo_gi', $id_trafo_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_input',[
            'data' => $data,
            'gi' => null, 't_gi' => $t_gi, 'penyulang' => null
        ]);
    }

    public function list_gd($id_gi){
        $penyulang = Penyulang::where('id', $id_gi)->first();
        $data = Gardu::where('id_penyulang', $id_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_input',[
            'data' => $data,
            'gi' => null, 't_gi' => null, 'penyulang' => $penyulang
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
        elseif($request->tipe=="gardu"|| $request->tipe=="pct" || $request->tipe=="tm"){
            $data_listrik = PenyimpananGardu::where('periode', date('Ym'))->where('id_gardu', $request->id)->first();
        }
        if($data_listrik){
            $decoded = json_decode($data_listrik->data,true);
            if($request->tipe=="pct") {
                $meter=$request->meter;
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli'][$meter]['download']['kvarh_download']
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli'][$meter]['visual']['kvarh_visual']
                    );
                }
            }
            elseif($request->tipe=="trafo_gi") {
                $meter=$request->meter;
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli'][$meter]['download']['kvarh_download']
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli'][$meter]['visual']['kvarh_visual']
                    );
                }
            }
            else{
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli']['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli']['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli']['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli']['download']['kvarh_download']
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli']['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli']['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli']['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli']['visual']['kvarh_visual']
                    );
                }
            }

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
            $data_olah = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter);

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
                    $data_input = array(
                        'utama' => $data,
                        'pembanding' => $data2,
                        'ps' => $data2
                    );
                }
                elseif($request->meter=="pembanding") {
                    $data_input = array(
                        'utama' => $data2,
                        'pembanding' => $data,
                        'ps' => $data2
                    );
                }
                elseif($request->meter=="ps") {
                    $data_input = array(
                        'utama' => $data2,
                        'pembanding' => $data2,
                        'ps' =>  $data,
                    );
                }
                $dt = array(
                    'beli' => $data_input,
                    'hasil_pengolahan' => $data_olah
                );

//                dd($data1);
            }
            elseif($request->tipe=="pct"){
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

                if($request->meter=="impor") {
                    $data_input = array(
                        'impor' => $data,
                        'ekspor' => $data2,
                        'lokasi' => ""
                    );
                }
                elseif($request->meter=="ekspor") {
                    $data_input = array(
                        'impor' => $data2,
                        'ekspor' => $data,
                        'lokasi' => ""
                    );
                }
                $dt = array(
                    'beli' => $data_input,
                    'hasil_pengolahan' => $data_olah
                );
            }
            else{
                $dt = array(
                    'beli' => $data,
                    'hasil_pengolahan' => $data_olah
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
            }
            elseif ($request->tipe == "penyulang") {
                $P = new PenyimpananPenyulang();
                $P->id_penyulang= $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananPenyulang::where('periode', $date)->where('id_penyulang', $request->id)->first();
            }
            elseif ($request->tipe == "gardu"|| $request->tipe=="pct" || $request->tipe=="tm") {
                $P = new PenyimpananGardu();
                $P->id_gardu = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
                $P->data_keluar = "";
                $data_awal = PenyimpananGardu::where('periode', $date)->where('id_gardu', $request->id)->first();
            }

            if($data_awal){
                $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter);
                $P->data = json_encode($data);
                if ($P->save());
            }
            else {
                $P->data = json_encode($dt);
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
        elseif($tipe=="gardu"|| $tipe=="pct" || $tipe=="tm"){
            $awal = PenyimpananGardu::where('periode', $date)->where('id_gardu', $id)->first();
            $data_master = Gardu::where('id', $id)->first();
            $akhir = PenyimpananGardu::where('periode', $date_)->where('id_gardu', $id)->first();
        }

        $data_master = json_decode($data_master->data_master, true);
        if($tipe=="trafo_gi")
            $faktor_kali = (int)$data_master[$meter]['FK']['faktorkali'];
        elseif($tipe=="pct")
            $faktor_kali = (int)$data_master['meter']['FK']['faktorkali'];
        else
            $faktor_kali = (int)$data_master['FK']['faktorkali'];

        if($tipe=="trafo_gi"||$tipe=="pct"){
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
                elseif($meter=="impor"){
                    $dt = array(
                        'impor'=>$update,
                        'ekspor'=>null,
                        'lokasi'=> null
                    );
                    $dt2 = array(
                        'impor'=>null,
                        'ekspor'=>$olah,
                        'lokasi'=> null
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }
                elseif($meter=="ekspor"){
                    $dt = array(
                        'impor'=>null,
                        'ekspor'=>$update,
                        'lokasi'=> null
                    );
                    $dt2 = array(
                        'impor'=>$olah,
                        'ekspor'=>null,
                        'lokasi'=> null
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
                elseif($meter=="impor"){
                    $dt = array(
                        'impor'=>$update,
                        'ekspor'=>$akhir['beli']['ekspor'],
                        'lokasi'=> null
                    );
                    $dt2 = array(
                        'impor'=>$olah,
                        'ekspor'=>$akhir['hasil_pengolahan']['ekspor'],
                        'lokasi'=> null
                    );
                    $dt = array(
                        'beli'=> $dt,
                        'hasil_pengolahan'=> $dt2
                    );
                }
                elseif($meter=="ekspor"){
                    $dt = array(
                        'impor'=>$akhir['beli']['impor'],
                        'ekspor'=>$update,
                        'lokasi'=> null
                    );
                    $dt2 = array(
                        'impor'=>$akhir['hasil_pengolahan']['impor'],
                        'ekspor'=>$olah,
                        'lokasi'=> null
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
//            dd($dt);

        }
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
            if($tipe=="trafo_gi"||$tipe=="pct"){
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
        else{
            $lwbp1_visual=null;
            $lwbp2_visual=null;
            $wbp_visual=null;
            $kvarh_visual=null;
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
            if($tipe=="trafo_gi"||$tipe=="pct"){
                $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli'][$meter]['download']['lwbp1_download']);
                $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli'][$meter]['download']['lwbp2_download']);
                $wbp_download =  ($download['wbp_download'] - $data_awal['beli'][$meter]['download']['wbp_download']);
                $kvarh_download = ($download['kvarh_download'] - $data_awal['beli'][$meter]['download']['kvarh_download']);
            }else{
                $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli']['download']['lwbp1_download']);
                $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli']['download']['lwbp2_download']);
                $wbp_download =  ($download['wbp_download'] - $data_awal['beli']['download']['wbp_download']);
                $kvarh_download = ($download['kvarh_download'] - $data_awal['beli']['download']['kvarh_download']);
            }
        }
        else{
            $lwbp1_download=null;
            $lwbp2_download=null;
            $wbp_download=null;
            $kvarh_download=null;
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
            $data_pengolahan = array(
                'visual' => $data_visual2,
                'download' => $data_download2
            );
        }

        $dt = array(
            'beli' => $data,
            'hasil_pengolahan' => $data_pengolahan
        );
//        dd($dt);
        if($tipe=="trafo_gi"||$tipe=="pct")
            return array ($data, $data_pengolahan);
        else return $dt;
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
        elseif($tipe=="gd" || $tipe=="pct" || $tipe=="tm"){
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
            elseif($tipe=="pct"){
                $data_awal = array(
                    'impor' => $data_awal,
                    'ekspor' => $data_awal,
                    'lokasi' => "",
                );
            }
            $data =array(
                'beli'=>$data_awal,
                'hasil_pengolahan'=> null
            );

//            $hasil = json_encode($data);
//            $data = json_decode($hasil, true);
        }
        $decoded = json_decode($jenis->data_master,true);
//        dd($data);
        return view('admin.nonmaster.dashboard_user.input_data', [
            'data'            => $data,
            'decoded'         => $decoded,
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