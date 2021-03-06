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
use App\Transfer;
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

//    public function list_gardu_induk($id_rayon){
//        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
//        $id_org = $rayon[0]->id;
//        $data = GI::where('id_organisasi', $id_org)->get();
//        return view('admin.nonmaster.dashboard_user.list_input_gardu_induk',[
//            'data' =>$data
//        ]);
//    }

    public function list_gardu_induk($id_rayon){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->first();
        $data = GI::where('id_organisasi', $rayon->id)->get();
        $id_ryn = Organisasi::where('id_organisasi', $id_rayon)->first();

        $transfer = Transfer::select('transfer.id', 'transfer.id_trafo_gi', 'transfer.id_penyulang')
            ->where('transfer.id_organisasi', $rayon->id)
            ->join('trafo_gi', 'transfer.id_trafo_gi', '=', 'trafo_gi.id')
            ->select('transfer.id', 'trafo_gi.id_gi', 'trafo_gi.id', 'transfer.id_penyulang')
            ->join('gi', 'trafo_gi.id_gi', '=', 'gi.id')
            ->select('transfer.id as id_trans', 'gi.id', 'gi.nama_gi', 'transfer.id_penyulang', 'transfer.id_gi')
            ->get()->toArray();

        foreach ($transfer as $trans) {
            $query = Transfer::where('id', $trans['id_trans'])->update(['id_gi' => $trans['id']]);
        }

        $data2 = Transfer::select('transfer.id_organisasi','transfer.id_gi', 'gi.nama_gi', 'gi.alamat_gi')
            ->join('GI','GI.id','=','transfer.id_gi')->distinct('transfer.id_gi')
            ->where('transfer.id_organisasi', $id_ryn->id)->get();

        return view('admin.nonmaster.dashboard_user.list_input_gardu_induk',[
            'data' =>$data,
            'data2' =>$data2,
        ]);
    }
    public function list_trafo_gi($id_gi){
        $user = Auth::user()->id;
        $org = GI::where('id',$id_gi)->where('id_organisasi',$user)->get();
        $gi = GI::where('id', $id_gi)->first();
        if(count($org) >0) {
            $data = TrafoGI::where('id_gi', $id_gi)->get();
            $transfer =false;
        }
        else{
            $transfer =true;
            $t_gi = TrafoGI::where('id_gi', $gi->id)->pluck('id');
            $dt_ =array();
            foreach ($t_gi as $tgi){
                $trans = Transfer::where('id_trafo_gi', $tgi)->where('id_organisasi',$user)->pluck('id_penyulang');
                $dt = Penyulang::whereIn('id', $trans)->get();
                if(count($dt)>0){
                    $dt = TrafoGI::where('id', $tgi)->first();
                    array_push($dt_,$dt);
                }
            }
            $data = $dt_;

        }
        return view('admin.nonmaster.dashboard_user.list_input',[
            'transfer' => $transfer,
            'data' => $data,
            'gi' =>$gi, 't_gi' => null, 'penyulang' => null,'tipe' => "rayon"
        ]);
    }


    public function list_penyulang($id_trafo_gi){
        $user = Auth::user()->id;
        $org = TrafoGI::where('id',$id_trafo_gi)->where('id_organisasi',$user)->get();
//        dd($org);
        if(count($org) >0){
            $transfer =false;
            $t_gi = TrafoGI::where('id', $id_trafo_gi)->first();
            $data = Penyulang::where('id_trafo_gi', $id_trafo_gi)->get();
        }
        else {
            $t_gi = TrafoGI::where('id', $id_trafo_gi)->first();
            $data = Transfer::where('id_trafo_gi', $id_trafo_gi)->where('id_organisasi',$user)->pluck('id_penyulang');
            $data = Penyulang::whereIn('id', $data)->get();
            $transfer =true;
        }
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_input',[
            'transfer' => $transfer,
            'data' => $data,
            'gi' => null, 't_gi' => $t_gi, 'penyulang' => null, 'tipe' => "rayon"
        ]);
    }

    public function list_gd($id_penyulang){
//        dd($id_penyulang);
        $penyulang = Penyulang::where('id', $id_penyulang)->first();
        $data = Gardu::where('id_penyulang', $id_penyulang)->get();
        return view('admin.nonmaster.dashboard_user.list_input',[
            'data' => $data,
            'gi' => null, 't_gi' => null, 'penyulang' => $penyulang,'tipe' => "rayon"
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

    public function refresh_input($request,$data_awal){
        if(date("m")<3){
            if(date("m")==1){
                $date_prev = (date("Y")-1)."11";
                $date_now =  (date("Y")-1)."12";
            }
            else{
                $date_prev = (date("Y") - 1) . "12";
                $date_now = date("Ym") - 1;}
        }else{
            $date_now = date("Ym")-1;
        }

        $data_beli =json_decode($data_awal->data,true)['beli'];
        if($request->tipe=="trafo_gi") {
            $input_visual = array(
                'lwbp1_visual' => $data_beli[$request->meter]['visual']['lwbp1_visual'],
                'lwbp2_visual' => $data_beli[$request->meter]['visual']['lwbp2_visual'],
                'wbp_visual' => $data_beli[$request->meter]['visual']['wbp_visual'],
                'kvarh_visual' => $data_beli[$request->meter]['visual']['kvarh_visual'],
                'konsiden_visual' => $data_beli[$request->meter]['visual']['konsiden_visual']
            );
            $input_download = array(
                'lwbp1_download' => $data_beli[$request->meter]['download']['lwbp1_download'],
                'lwbp2_download' => $data_beli[$request->meter]['download']['lwbp2_download'],
                'wbp_download' => $data_beli[$request->meter]['download']['wbp_download'],
                'kvarh_download' => $data_beli[$request->meter]['download']['kvarh_download'],
                'konsiden_download' => $data_beli[$request->meter]['download']['konsiden_download']
            );
        }
        elseif($request->tipe=="penyulang"){
            $input_visual = array(
                'lwbp1_visual' => $data_beli['visual']['lwbp1_visual'],
                'lwbp2_visual' => $data_beli['visual']['lwbp2_visual'],
                'wbp_visual' => $data_beli['visual']['wbp_visual'],
                'kvarh_visual' => $data_beli['visual']['kvarh_visual'],
                'tu_visual' => $data_beli['visual']['tu_visual']
            );
            $input_download = array(
                'lwbp1_download' => $data_beli['download']['lwbp1_download'],
                'lwbp2_download' => $data_beli['download']['lwbp2_download'],
                'wbp_download' => $data_beli['download']['wbp_download'],
                'kvarh_download' => $data_beli['download']['kvarh_download'],
                'tu_download' => $data_beli['download']['tu_download']
            );
        }
        if($request->tipe=="gi"){
            $data_listrik = PenyimpananGI::where('periode', $date_now)->where('id_gi', $request->id)->first();
        }
        elseif($request->tipe=="trafo_gi"){
            $data_listrik = PenyimpananTrafoGI::where('periode',  $date_now)->where('id_trafo_gi', $request->id)->first();
        }
        elseif($request->tipe=="penyulang"){
            $data_listrik = PenyimpananPenyulang::where('periode',  $date_now)->where('id_penyulang', $request->id)->first();
        }

        if($data_listrik){
            $decoded = json_decode($data_listrik->data,true);
            if($request->tipe=="trafo_gi") {
                $meter=$request->meter;
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli'][$meter]['download']['kvarh_download'],
                        'konsiden_download' => $decoded['beli'][$meter]['download']['konsiden_download']
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli'][$meter]['visual']['kvarh_visual'],
                        'konsiden_visual' => $decoded['beli'][$meter]['visual']['konsiden_visual']
                    );
                }
            }
            elseif($request->tipe=="penyulang"){
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli']['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli']['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli']['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli']['download']['kvarh_download'],
                        'tu_download' => $decoded['beli']['download']['tu_download']
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli']['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli']['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli']['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli']['visual']['kvarh_visual'],
                        'tu_visual' => $decoded['beli']['visual']['tu_visual']
                    );
                }
            }
            else{
                if($request->visual){
                    $input_download = array(
                        'lwbp1_download' => $decoded['beli']['download']['lwbp1_download'],
                        'lwbp2_download' => $decoded['beli']['download']['lwbp2_download'],
                        'wbp_download' => $decoded['beli']['download']['wbp_download'],
                        'kvarh_download' => $decoded['beli']['download']['kvarh_download'],
                    );
                }
                elseif ($request->download){
                    $input_visual = array(
                        'lwbp1_visual' => $decoded['beli']['visual']['lwbp1_visual'],
                        'lwbp2_visual' => $decoded['beli']['visual']['lwbp2_visual'],
                        'wbp_visual' => $decoded['beli']['visual']['wbp_visual'],
                        'kvarh_visual' => $decoded['beli']['visual']['kvarh_visual'],
                    );
                }
            }
            $jual= $request->tpe_jual;
            $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter,$request->jual, $jual);
            if(!$request->tpe_jual)  $data['jual']['total_kwh_jual']=$decoded['jual']['total_kwh_jual'];
            $data_listrik->data = json_encode($data);
            if($data_listrik->save());
            return back();
        }
    }

    public function store(Request $request)
    {
        if(date("m")<3){
            if(date("m")==1){
                $date_prev = (date("Y")-1)."11";
                $date_now =  (date("Y")-1)."12";
            }
            else{
                $date_prev = (date("Y") - 1) . "12";
                $date_now = date("Ym") - 1;}
        }else{
            $date_prev = (date("Ym")-2);
            $date_now = date("Ym")-1;
        }

        if($request->lalu) {
            $input_visual = array(
                'lwbp1_visual' => $request->lwbp1_visual_lalu,
                'lwbp2_visual' => $request->lwbp2_visual_lalu,
                'wbp_visual' => $request->wbp_visual_lalu,
                'total_pemakaian_kwh_visual' => $request->tpe_visual_lalu,
            );
            $input_download = array(
                'lwbp1_download' => $request->lwbp1_download_lalu,
                'lwbp2_download' => $request->lwbp2_download_lalu,
                'wbp_download' => $request->wbp_download_lalu,
                'total_pemakaian_kwh_download' => $request->tpe_download_lalu,
            );
            if ($request->tipe == "trafo_gi") {
                $cek_dataL =true;
                $data_lalu = PenyimpananTrafoGI::where('periode', "L".$date_prev)->where('id_trafo_gi', $request->id)->first();
                if(count($data_lalu )==0){
                    $data_lalu = PenyimpananTrafoGI::where('periode', $date_prev)->where('id_trafo_gi', $request->id)->first();
                    $cek_dataL =false;
                }
                if($data_lalu){
                    $decoded = json_decode($data_lalu->data,true);
                    $meter=$request->meter;
                    if($request->visual){
                        if($cek_dataL)
                        $input_download = array(
                            'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                            'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                            'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                            'total_pemakaian_kwh_download' => $decoded['hasil_pengolahan'][$meter]['download']['total_pemakaian_kwh_download']
                        );
                        else
                        $input_download = array(
                            'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                            'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                            'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                            'kvarh_download' => $decoded['beli'][$meter]['download']['kvarh_download'],
                            'konsiden_download' => $decoded['beli'][$meter]['download']['konsiden_download'],
                        );
//                        if($decoded['beli']['ps']['download']==null)
//                        dd($decoded);
                    }
                    elseif ($request->download){
                        if($cek_dataL)
                        $input_visual = array(
                            'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                            'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                            'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                            'total_pemakaian_kwh_visual' => $decoded['hasil_pengolahan'][$meter]['visual']['total_pemakaian_kwh_visual']
                        );
                        else
                        $input_visual = array(
                            'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                            'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                            'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                            'kvarh_visual' => $decoded['beli'][$meter]['visual']['kvarh_visual'],
                            'konsiden_visual' => $decoded['beli'][$meter]['visual']['konsiden_visual'],
                        );
                    }

                    if($request->meter == "utama"){
                        if($cek_dataL) {
                            if ($request->visual){
                                $decoded['beli']["utama"]['visual']['lwbp1_visual'] = $request->lwbp1_visual_lalu;
                                $decoded['beli']["utama"]['visual']['lwbp2_visual'] = $request->lwbp2_visual_lalu;
                                $decoded['beli']["utama"]['visual']['wbp_visual'] = $request->wbp_visual_lalu;
                                $decoded['hasil_pengolahan']["utama"]['visual']['total_pemakaian_kwh_visual'] = $request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["utama"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["utama"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["utama"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['hasil_pengolahan']["utama"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                        else{
                            if($decoded['hasil_pengolahan']["utama"]);
                            else {
                                if($request->visual)
                                    $decoded['hasil_pengolahan']["utama"]['download']['total_pemakaian_kwh_download']=null;
                                elseif ($request->download)
                                    $decoded['hasil_pengolahan']["utama"]['visual']['total_pemakaian_kwh_visual']=null;
                            }
                            if($request->visual){
                                $decoded['beli']["utama"]['visual']['lwbp1_visual']=$request->lwbp1_visual_lalu;
                                $decoded['beli']["utama"]['visual']['lwbp2_visual']=$request->lwbp2_visual_lalu;
                                $decoded['beli']["utama"]['visual']['wbp_visual']=$request->wbp_visual_lalu;
                                $decoded['beli']["utama"]['visual']['kvarh_visual']=$request->kvarh_visual_lalu;
                                $decoded['beli']["utama"]['visual']['konsiden_visual']=$request->konsiden_visual_lalu;
                                $decoded['hasil_pengolahan']["utama"]['visual']['total_pemakaian_kwh_visual']=$request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["utama"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["utama"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["utama"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['beli']["utama"]['download']['kvarh_download']=$request->kvarh_download_lalu;
                                $decoded['beli']["utama"]['download']['konsiden_download']=$request->konsiden_download_lalu;
                                $decoded['hasil_pengolahan']["utama"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                    }
                    elseif($request->meter == "pembanding"){
                        if($cek_dataL) {
                            if ($request->visual){
                                $decoded['beli']["pembanding"]['visual']['lwbp1_visual'] = $request->lwbp1_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['lwbp2_visual'] = $request->lwbp2_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['wbp_visual'] = $request->wbp_visual_lalu;
                                $decoded['hasil_pengolahan']["pembanding"]['visual']['total_pemakaian_kwh_visual'] = $request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["pembanding"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["pembanding"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["pembanding"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['hasil_pengolahan']["pembanding"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                        else{
                            if($decoded['hasil_pengolahan']["pembanding"]);
                            else {
                                if($request->visual)
                                    $decoded['hasil_pengolahan']["pembanding"]['download']['total_pemakaian_kwh_download']=null;
                                elseif ($request->download)
                                    $decoded['hasil_pengolahan']["pembanding"]['visual']['total_pemakaian_kwh_visual']=null;
                            }

                            if($request->visual){
                                $decoded['beli']["pembanding"]['visual']['lwbp1_visual']=$request->lwbp1_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['lwbp2_visual']=$request->lwbp2_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['wbp_visual']=$request->wbp_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['kvarh_visual']=$request->kvarh_visual_lalu;
                                $decoded['beli']["pembanding"]['visual']['konsiden_visual']=$request->konsiden_visual_lalu;
                                $decoded['hasil_pengolahan']["pembanding"]['visual']['total_pemakaian_kwh_visual']=$request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["pembanding"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["pembanding"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["pembanding"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['beli']["pembanding"]['download']['kvarh_download']=$request->kvarh_download_lalu;
                                $decoded['beli']["pembanding"]['download']['konsiden_download']=$request->konsiden_download_lalu;
                                $decoded['hasil_pengolahan']["pembanding"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                    }
                    elseif($request->meter == "ps"){
                        if($cek_dataL) {
                            if ($request->visual){
                                $decoded['beli']["ps"]['visual']['lwbp1_visual'] = $request->lwbp1_visual_lalu;
                                $decoded['beli']["ps"]['visual']['lwbp2_visual'] = $request->lwbp2_visual_lalu;
                                $decoded['beli']["ps"]['visual']['wbp_visual'] = $request->wbp_visual_lalu;
                                $decoded['hasil_pengolahan']["ps"]['visual']['total_pemakaian_kwh_visual'] = $request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["ps"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["ps"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["ps"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['hasil_pengolahan']["ps"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                        else{
                            if($decoded['hasil_pengolahan']["ps"]);
                            else {
                                if($request->visual)
                                    $decoded['hasil_pengolahan']["ps"]['download']['total_pemakaian_kwh_download']=null;
                                elseif ($request->download)
                                    $decoded['hasil_pengolahan']["ps"]['visual']['total_pemakaian_kwh_visual']=null;
                            }
                            if($request->visual){
                                $decoded['beli']["ps"]['visual']['lwbp1_visual']=$request->lwbp1_visual_lalu;
                                $decoded['beli']["ps"]['visual']['lwbp2_visual']=$request->lwbp2_visual_lalu;
                                $decoded['beli']["ps"]['visual']['wbp_visual']=$request->wbp_visual_lalu;
                                $decoded['beli']["ps"]['visual']['kvarh_visual']=$request->kvarh_visual_lalu;
                                $decoded['beli']["ps"]['visual']['konsiden_visual']=$request->konsiden_visual_lalu;
                                $decoded['hasil_pengolahan']["ps"]['visual']['total_pemakaian_kwh_visual']=$request->tpe_visual_lalu;
                            }
                            elseif ($request->download){
                                $decoded['beli']["ps"]['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                                $decoded['beli']["ps"]['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                                $decoded['beli']["ps"]['download']['wbp_download']=$request->wbp_download_lalu;
                                $decoded['beli']["ps"]['download']['kvarh_download']=$request->kvarh_download_lalu;
                                $decoded['beli']["ps"]['download']['konsiden_download']=$request->konsiden_download_lalu;
                                $decoded['hasil_pengolahan']["ps"]['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                            }
                        }
                    }

                    $data_lalu->data=json_encode($decoded);
                    if($data_lalu->save());
                    //REFRESH LINK
                    $data_awal = PenyimpananTrafoGI::where('periode', $date_now)->where('id_trafo_gi', $request->id)->first();
                    if(count($data_awal)>0)
                        $this->refresh_input($request,$data_awal);

                    return back();
                }
                else{
                    $input_visual2 = array(
                        'lwbp1_visual' => null,
                        'lwbp2_visual' => null,
                        'wbp_visual' => null,
                        'total_pemakaian_kwh_visual' => null,
                    );
                    $input_download2 = array(
                        'lwbp1_download' => null,
                        'lwbp2_download' => null,
                        'wbp_download' => null,
                        'total_pemakaian_kwh_download' => null,
                    );

                    $dt = array(
                        'visual' => $input_visual,
                        'download' => $input_download,
                    );
                    $dt2 = array(
                        'visual' => $input_visual2,
                        'download' => $input_download2,
                    );

                    if($request->meter == "utama"){
                        $data = array(
                            "utama" =>$dt,
                            "pembanding" =>$dt2,
                            "ps" =>$dt2,
                        );
                    }
                    elseif($request->meter == "pembanding"){
                        $data = array(
                            "utama" =>$dt2,
                            "pembanding" =>$dt,
                            "ps" =>$dt2,
                        );
                    }
                    elseif($request->meter == "ps"){
                        $data = array(
                            "utama" =>$dt2,
                            "pembanding" =>$dt2,
                            "ps" =>$dt,
                        );
                    }
                    $data_akhir = array(
                        'beli' => $data,
                        'hasil_pengolahan' => $data,
                    );

                    $P = new PenyimpananTrafoGI();
                    $P->id_trafo_gi = $request->id;
                    $P->periode = "L".$date_prev;
                    $P->data = json_encode($data_akhir);
                    $P->data_keluar = "";
                    if($P->save());
                    $data_awal = PenyimpananTrafoGI::where('periode', $date_now)->where('id_trafo_gi', $request->id)->first();
                    if(count($data_awal)>0)
                        $this->refresh_input($request,$data_awal);
                    return back();

                }

            }
            elseif ($request->tipe == "penyulang"){
                $cek_dataL =true;
                $data_lalu = PenyimpananPenyulang::where('periode', "L".$date_prev)->where('id_penyulang', $request->id)->first();
                if(count($data_lalu)==0){
                    $data_lalu = PenyimpananPenyulang::where('periode', $date_prev)->where('id_penyulang', $request->id)->first();
                    $cek_dataL =false;
                }
                if($data_lalu){
                    $decoded = json_decode($data_lalu->data,true);
                    if($cek_dataL){
                        if($request->visual){
                            $decoded['beli']['visual']['lwbp1_visual']=$request->lwbp1_visual_lalu;
                            $decoded['beli']['visual']['lwbp2_visual']=$request->lwbp2_visual_lalu;
                            $decoded['beli']['visual']['wbp_visual']=$request->wbp_visual_lalu;
                            $decoded['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']=$request->tpe_visual_lalu;
                        }
                        elseif ($request->download){
                            $decoded['beli']['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                            $decoded['beli']['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                            $decoded['beli']['download']['wbp_download']=$request->wbp_download_lalu;
                            $decoded['hasil_pengolahan']['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                        }
                    }
                    else{
                        if($request->visual){
                            $decoded['beli']['visual']['lwbp1_visual']=$request->lwbp1_visual_lalu;
                            $decoded['beli']['visual']['lwbp2_visual']=$request->lwbp2_visual_lalu;
                            $decoded['beli']['visual']['wbp_visual']=$request->wbp_visual_lalu;
                            $decoded['beli']['visual']['kvarh_visual']=$request->kvarh_visual_lalu;
                            $decoded['beli']['visual']['tu_visual']=$request->konsiden_visual_lalu;
                            $decoded['hasil_pengolahan']['visual']['total_pemakaian_kwh_visual']=$request->tpe_visual_lalu;
                        }
                        elseif ($request->download){
                            $decoded['beli']['download']['lwbp1_download']=$request->lwbp1_download_lalu;
                            $decoded['beli']['download']['lwbp2_download']=$request->lwbp2_download_lalu;
                            $decoded['beli']['download']['wbp_download']=$request->wbp_download_lalu;
                            $decoded['beli']['download']['kvarh_download']=$request->kvarh_download_lalu;
                            $decoded['beli']['download']['tu_download']=$request->konsiden_download_lalu;
                            $decoded['hasil_pengolahan']['download']['total_pemakaian_kwh_download']=$request->tpe_download_lalu;
                        }
                    }
                    $data_lalu->data=json_encode($decoded);
                    if($data_lalu->save());

                    $data_awal = PenyimpananPenyulang::where('periode', $date_now)->where('id_penyulang', $request->id)->first();
                    if(count($data_awal)>0)
                        $this->refresh_input($request,$data_awal);

                    return back();
                }
                else{

                    $data = array(
                        'visual' => $input_visual,
                        'download' => $input_download,
                    );

                    $data_akhir = array(
                        'beli' => $data,
                        'hasil_pengolahan' => $data,
                    );

                    $P = new PenyimpananPenyulang();
                    $P->id_penyulang = $request->id;
                    $P->periode = "L".$date_prev;
                    $P->data = json_encode($data_akhir);
                    $P->data_keluar = "";
                    if($P->save());
                    $data_awal = PenyimpananPenyulang::where('periode', $date_now)->where('id_penyulang', $request->id)->first();
                    if($data_awal)
                        $this->refresh_input($request,$data_awal);
                    return back();
                }
            }
        }
        else{
//
            if($request->tipe=="trafo_gi") {
                $input_visual = array(
                    'lwbp1_visual' => $request->lwbp1_visual,
                    'lwbp2_visual' => $request->lwbp2_visual,
                    'wbp_visual' => $request->wbp_visual,
                    'kvarh_visual' => $request->kvarh_visual,
                    'konsiden_visual' => $request->konsiden_visual
                );
                $input_download = array(
                    'lwbp1_download' => $request->lwbp1_download,
                    'lwbp2_download' => $request->lwbp2_download,
                    'wbp_download' => $request->wbp_download,
                    'kvarh_download' => $request->kvarh_download,
                    'konsiden_download' => $request->konsiden_download
                );
            }
            elseif($request->tipe=="penyulang"){
                $input_visual = array(
                    'lwbp1_visual' => $request->lwbp1_visual,
                    'lwbp2_visual' => $request->lwbp2_visual,
                    'wbp_visual' => $request->wbp_visual,
                    'kvarh_visual' => $request->kvarh_visual,
                    'tu_visual' => $request->tu_visual
                );
                $input_download = array(
                    'lwbp1_download' => $request->lwbp1_download,
                    'lwbp2_download' => $request->lwbp2_download,
                    'wbp_download' => $request->wbp_download,
                    'kvarh_download' => $request->kvarh_download,
                    'tu_download' => $request->tu_download
                );
            }
            elseif($request->tipe=="pct"){
                $input_visual = array(
                    'awal_visual' => $request->awal_visual,
                    'akhir_visual' => $request->akhir_visual,
                );
                $input_download = array(
                    'total_kwh_download' => $request->total_kwh_download,
                );
            }
            else{
                $input_visual = array(
                    'lwbp1_visual' => $request->lwbp1_visual,
                    'lwbp2_visual' => $request->lwbp2_visual,
                    'wbp_visual' => $request->wbp_visual,
                    'kvarh_visual' => $request->kvarh_visual,
                );
                $input_download = array(
                    'lwbp1_download' => $request->lwbp1_download,
                    'lwbp2_download' => $request->lwbp2_download,
                    'wbp_download' => $request->wbp_download,
                    'kvarh_download' => $request->kvarh_download,
                );
            }

            if($request->tipe=="gi"){
                $data_listrik = PenyimpananGI::where('periode', $date_now)->where('id_gi', $request->id)->first();
            }
            elseif($request->tipe=="trafo_gi"){
                $data_listrik = PenyimpananTrafoGI::where('periode',  $date_now)->where('id_trafo_gi', $request->id)->first();
            }
            elseif($request->tipe=="penyulang"){
                $data_listrik = PenyimpananPenyulang::where('periode',  $date_now)->where('id_penyulang', $request->id)->first();
            }
            elseif($request->tipe=="pct"){
                $data_listrik = PenyimpananGardu::where('periode', $date_now)->where('id_gardu', $request->id)->first();
            }
            elseif($request->tipe=="gd"||  $request->tipe=="tm"){
                $data_listrik = PenyimpananGardu::where('periode', $date_now)->where('id_gardu', $request->id)->first();
            }
            if($data_listrik){
                $decoded = json_decode($data_listrik->data,true);
                if($request->tipe=="pct") {
                    $meter=$request->meter;
                    if($request->visual){
                        $input_download = array(
                            'total_kwh_download' => $decoded['beli'][$meter]['download']['total_kwh_download'],
                        );
                    }
                    elseif ($request->download){
                        $input_visual = array(
                            'awal_visual' => $decoded['beli'][$meter]['visual']['awal_visual'],
                            'akhir_visual' => $decoded['beli'][$meter]['visual']['akhir_visual'],
                        );
                    }
                    $fk = Gardu::where('id', $request->id)->first();
                    $fk = json_decode($fk['data_master'],true)['meter']['FK']['faktorkali'];
                    if($meter == "impor"){
                        $dt_impor = array(
                            'visual' => $input_visual,
                            'download' => $input_download,
                        );
                        $input_visual = array(
                            'awal_visual' => $decoded['beli']['ekspor']['visual']['awal_visual'],
                            'akhir_visual' => $decoded['beli']['ekspor']['visual']['akhir_visual'],
                        );
                        $input_download = array(
                            'total_kwh_download' => $decoded['beli']['ekspor']['download']['total_kwh_download'],
                        );
                        $dt_ekspor = array(
                            'visual' => $input_visual,
                            'download' => $input_download,
                        );
                        if($request->visual)
                            $hasil_impor = array(
                                'total_kwh_visual' => ($request->akhir_visual -$request->awal_visual)*$fk,
                                'total_kwh_download' => $decoded['hasil_pengolahan']['impor']['total_kwh_download'],
                            );
                        else
                            $hasil_impor = array(
                                'total_kwh_visual' => $decoded['hasil_pengolahan']['impor']['total_kwh_visual'],
                                'total_kwh_download' => $request->total_kwh_download,
                            );

                        $hasil_ekspor = array(
                            'total_kwh_visual' =>  $decoded['hasil_pengolahan']['ekspor']['total_kwh_visual'],
                            'total_kwh_download' =>  $decoded['hasil_pengolahan']['ekspor']['total_kwh_download'],
                        );
                    }
                    elseif($meter == "ekspor"){
                        $dt_ekspor = array(
                            'visual' => $input_visual,
                            'download' => $input_download,
                        );
                        $input_visual = array(
                            'awal_visual' => $decoded['beli']['impor']['visual']['awal_visual'],
                            'akhir_visual' => $decoded['beli']['impor']['visual']['akhir_visual'],
                        );
                        $input_download = array(
                            'total_kwh_download' => $decoded['beli']['impor']['download']['total_kwh_download'],
                        );
                        $dt_impor = array(
                            'visual' => $input_visual,
                            'download' => $input_download,
                        );
                        if($request->visual)
                            $hasil_ekspor = array(
                                'total_kwh_visual' => ($request->akhir_visual -$request->awal_visual)*$fk,
                                'total_kwh_download' => $decoded['hasil_pengolahan']['ekspor']['total_kwh_download'],
                            );
                        else
                            $hasil_ekspor = array(
                                'total_kwh_visual' => $decoded['hasil_pengolahan']['ekspor']['total_kwh_visual'],
                                'total_kwh_download' => $request->total_kwh_download,
                            );
                        $hasil_impor = array(
                            'total_kwh_visual' =>  $decoded['hasil_pengolahan']['impor']['total_kwh_visual'],
                            'total_kwh_download' => $decoded['hasil_pengolahan']['impor']['total_kwh_download'],
                        );


                    }
                    $dt_beli = array(
                        'impor' => $dt_impor,
                        'ekspor' => $dt_ekspor,
                    );
                    $hasil = array(
                        'impor' => $hasil_impor,
                        'ekspor' => $hasil_ekspor,
                    );
                    $data = array(
                        'beli' => $dt_beli,
                        'hasil_pengolahan' => $hasil,
                    );
                    $data_listrik->data = json_encode($data);
                    if($data_listrik->save());
                    return back();
//
                }
                elseif($request->tipe=="trafo_gi") {
                    $meter=$request->meter;
                    if($request->visual){
                        $input_download = array(
                            'lwbp1_download' => $decoded['beli'][$meter]['download']['lwbp1_download'],
                            'lwbp2_download' => $decoded['beli'][$meter]['download']['lwbp2_download'],
                            'wbp_download' => $decoded['beli'][$meter]['download']['wbp_download'],
                            'kvarh_download' => $decoded['beli'][$meter]['download']['kvarh_download'],
                            'konsiden_download' => $decoded['beli'][$meter]['download']['konsiden_download']
                        );
                    }
                    elseif ($request->download){
                        $input_visual = array(
                            'lwbp1_visual' => $decoded['beli'][$meter]['visual']['lwbp1_visual'],
                            'lwbp2_visual' => $decoded['beli'][$meter]['visual']['lwbp2_visual'],
                            'wbp_visual' => $decoded['beli'][$meter]['visual']['wbp_visual'],
                            'kvarh_visual' => $decoded['beli'][$meter]['visual']['kvarh_visual'],
                            'konsiden_visual' => $decoded['beli'][$meter]['visual']['konsiden_visual']
                        );
                    }
                }
                elseif($request->tipe=="penyulang"){
                    if($request->visual){
                        $input_download = array(
                            'lwbp1_download' => $decoded['beli']['download']['lwbp1_download'],
                            'lwbp2_download' => $decoded['beli']['download']['lwbp2_download'],
                            'wbp_download' => $decoded['beli']['download']['wbp_download'],
                            'kvarh_download' => $decoded['beli']['download']['kvarh_download'],
                            'tu_download' => $decoded['beli']['download']['tu_download']
                        );
                    }
                    elseif ($request->download){
                        $input_visual = array(
                            'lwbp1_visual' => $decoded['beli']['visual']['lwbp1_visual'],
                            'lwbp2_visual' => $decoded['beli']['visual']['lwbp2_visual'],
                            'wbp_visual' => $decoded['beli']['visual']['wbp_visual'],
                            'kvarh_visual' => $decoded['beli']['visual']['kvarh_visual'],
                            'tu_visual' => $decoded['beli']['visual']['tu_visual']
                        );
                    }
                }
                else{
                    if($request->visual){
                        $input_download = array(
                            'lwbp1_download' => $decoded['beli']['download']['lwbp1_download'],
                            'lwbp2_download' => $decoded['beli']['download']['lwbp2_download'],
                            'wbp_download' => $decoded['beli']['download']['wbp_download'],
                            'kvarh_download' => $decoded['beli']['download']['kvarh_download'],
                        );
                    }
                    elseif ($request->download){
                        $input_visual = array(
                            'lwbp1_visual' => $decoded['beli']['visual']['lwbp1_visual'],
                            'lwbp2_visual' => $decoded['beli']['visual']['lwbp2_visual'],
                            'wbp_visual' => $decoded['beli']['visual']['wbp_visual'],
                            'kvarh_visual' => $decoded['beli']['visual']['kvarh_visual'],
                        );
                    }
                }
                $jual= $request->tpe_jual;
                $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter,$request->jual, $jual);
                if(!$request->jual)  $data['jual']['total_kwh_jual']=$decoded['jual']['total_kwh_jual'];
                $data_listrik->data = json_encode($data);
                if($data_listrik->save());
                return back();
            }
            else {
                $data = array(
                    'visual' => $input_visual,
                    'download' => $input_download
                );
                if($request->tipe == "pct");
                else{
                    $data_olah = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter,$request->jual, $request->tpe_jual);
                }
                if($request->tipe=="trafo_gi"){
                    $dt = $data_olah;
//                dd($dt);
                }
                elseif($request->tipe=="pct"){
                    $meter_visual = array(
                        'awal_visual' => null,
                        'akhir_visual' => null,
                    );
                    $meter_download = array(
                        'total_kwh_download' => null,
                    );
                    if($request->meter == "impor"){
                        $dt_impor = array(
                            'visual' => $input_visual,
                            'download' => $input_download
                        );
                        $dt_ekspor = array(
                            'visual' => $meter_visual,
                            'download' => $meter_download
                        );
                        $dt_ekspor2 = array(
                            'total_kwh_visual' => null,
                            'total_kwh_download' => null
                        );
                        $dt_impor2 = array(
                            'total_kwh_visual' => $request->akhir_visual - $request->awal_visual,
                            'total_kwh_download' => $request->total_kwh_download
                        );
                        $dt_beli = array(
                            'impor' => $dt_impor,
                            'ekspor' => $dt_ekspor,
                        );
                        $hasil = array(
                            'impor' => $dt_impor2,
                            'ekspor' => $dt_ekspor2,
                        );
                    }
                    elseif($request->meter == "ekspor"){
                        $dt_ekspor = array(
                            'visual' => $input_visual,
                            'download' => $input_download
                        );
                        $dt_impor = array(
                            'visual' => $meter_visual,
                            'download' => $meter_download
                        );
                        $dt_ekspor2 = array(
                            'total_kwh_visual' => $request->akhir_visual - $request->awal_visual,
                            'total_kwh_download' => $request->total_kwh_download
                        );
                        $dt_impor2 = array(
                            'total_kwh_visual' => null,
                            'total_kwh_download' => null
                        );

                        $dt_beli = array(
                            'impor' => $dt_impor,
                            'ekspor' => $dt_ekspor,
                        );
                        $hasil = array(
                            'impor' => $dt_impor2,
                            'ekspor' => $dt_ekspor2,
                         );
                    }
                    $data = array(
                        'beli' => $dt_beli,
                        'hasil_pengolahan' => $hasil,
                    );
//                    dd($data);
                    $P = new PenyimpananGardu();
                    $P->id_gardu = $request->id;
                    $P->periode = $date_now;
                    $P->data = json_encode($data);
                    $P->data_keluar = "";
                    if ($P->save());

                    return back();
                }
                else{
                    $dt = $data_olah;
                }
                if ($request->tipe == "gi") {
                    $P = new PenyimpananGI();
                    $P->id_gi = $request->id;
                    $P->periode = $date_now;
                    $P->data = json_encode($dt);
                    $P->data_keluar = "";
                    $data_awal = PenyimpananGI::where('periode', $date_now)->where('id_gi', $request->id)->first();
                }
                elseif ($request->tipe == "trafo_gi") {
                    $P = new PenyimpananTrafoGI();
                    $P->id_trafo_gi = $request->id;
                    $P->periode = $date_now;
                    $P->data = json_encode($dt);
                    $P->data_keluar = "";
                    $data_awal = PenyimpananTrafoGI::where('periode', $date_now)->where('id_trafo_gi', $request->id)->first();
                    $data_lalu = PenyimpananTrafoGI::where('periode', "L".$date_prev)->where('id_trafo_gi', $request->id)->first();
                }
                elseif ($request->tipe == "penyulang") {
                    $P = new PenyimpananPenyulang();
                    $P->id_penyulang= $request->id;
                    $P->periode = $date_now;
                    $P->data = json_encode($dt);
                    $P->data_keluar = "";
                    $data_awal = PenyimpananPenyulang::where('periode', $date_now)->where('id_penyulang', $request->id)->first();
                    $data_lalu = PenyimpananPenyulang::where('periode', "L".$date_prev)->where('id_penyulang', $request->id)->first();
                }
                elseif ($request->tipe == "gd"|| $request->tipe=="pct" || $request->tipe=="tm") {
                    $P = new PenyimpananGardu();
                    $P->id_gardu = $request->id;
                    $P->periode = $date_now;
                    $P->data = json_encode($dt);
                    $P->data_keluar = "";
                    $data_awal = PenyimpananGardu::where('periode', $date_now)->where('id_gardu', $request->id)->first();
                }

                if($data_awal||$data_lalu){
                    $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe, $request->meter,$request->jual, $request->tpe_jual);
//                dd($data);
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

    }

    public function olah_data($visual,$download,$id,$tipe,$meter,$jual,$kwh_jual){
        if(date("m")<3){
            if(date("m")==1){
                $date_prev = (date("Y")-1)."11";
                $date_now =  (date("Y")-1)."12";
            }
            else{
                $date_prev = (date("Y") - 1) . "12";
                $date_now = date("Ym") - 1;}
        }else{
            $date_prev = (date("Ym")-2);
            $date_now = date("Ym")-1;
        }

        $lalu = null;
        $boolean = true;
        if($tipe=="gi"){
            $awal = PenyimpananGI::where('periode', $date_prev)->where('id_gi', $id)->first();
            $data_master = GI::where('id', $id)->first();
            $akhir = PenyimpananGI::where('periode', $date_now)->where('id_gi', $id)->first();
        }
        elseif($tipe=="trafo_gi"){
            $lalu = PenyimpananTrafoGI::where('periode', "L".$date_prev)->where('id_trafo_gi', $id)->first();
            $awal = PenyimpananTrafoGI::where('periode', $date_prev)->where('id_trafo_gi', $id)->first();
            $data_master = TrafoGI::where('id', $id)->first();
            $akhir = PenyimpananTrafoGI::where('periode', $date_now)->where('id_trafo_gi', $id)->first();
        }
        elseif($tipe=="penyulang"){
            $lalu = PenyimpananPenyulang::where('periode', "L".$date_prev)->where('id_penyulang', $id)->first();
            $awal = PenyimpananPenyulang::where('periode', $date_prev)->where('id_penyulang', $id)->first();
            $data_master = Penyulang::where('id', $id)->first();
            $akhir = PenyimpananPenyulang::where('periode', $date_now)->where('id_penyulang', $id)->first();
        }
        elseif($tipe=="gd"|| $tipe=="pct" || $tipe=="tm"){
            $awal = PenyimpananGardu::where('periode', "L".$date_prev)->where('id_gardu', $id)->first();
            $data_master = Gardu::where('id', $id)->first();
            $akhir = PenyimpananGardu::where('periode', $date_now)->where('id_gardu', $id)->first();
        }
//        dd($date);
        if($data_master){
            $data_master = json_decode($data_master->data_master, true);
            if($jual)
                $faktor_kali = 1;
            elseif($tipe=="trafo_gi")
                    $faktor_kali = (int)$data_master[$meter]['FK']['faktorkali'];
            elseif($tipe=="pct")
                $faktor_kali = (int)$data_master['meter']['FK']['faktorkali'];
            else
                $faktor_kali = (int)$data_master['FK']['faktorkali'];
        }
        else
            $faktor_kali = null;

        if($tipe=="trafo_gi"||$tipe=="pct"){
            if($jual){
                if($akhir!==null)
                    $akhir = json_decode($akhir->data,true);
                $dt = array(
                    'utama'=>$akhir['beli']['utama'],
                    'pembanding'=> $akhir['beli']['pembanding'],
                    'ps'=>$akhir['beli']['ps']
                );
                $dt2 = array(
                    'utama'=>$akhir['hasil_pengolahan']['utama'],
                    'pembanding'=> $akhir['hasil_pengolahan']['pembanding'],
                    'ps'=>$akhir['hasil_pengolahan']['ps']
                );
                $dt_jual = array(
                    'total_kwh_jual'=> $kwh_jual
                );
                $dt = array(
                    'beli'=> $dt,
                    'hasil_pengolahan'=> $dt2,
                    'jual'=> $dt_jual
                );
            }
            else {
                if($lalu)
                    $diff =$this->json_dt($lalu,$visual,$download,$tipe,$meter,$faktor_kali,1);
                else  $diff =$this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali,0);

//                dd($diff);
                $dt = array(
                    'beli'=> $diff[0],
                    'hasil_pengolahan'=> $diff[1],

                );
                $update = $dt['beli'];
                $olah = $dt['hasil_pengolahan'];

                if(!$akhir){
                    $visual = array(
                        'lwbp1_visual' => null,
                        'lwbp2_visual' => null,
                        'wbp_visual' => null,
                        'kvarh_visual' => null,
                        'konsiden_visual' => null,
                    );

                    $download = array(
                        'lwbp1_download' => null,
                        'lwbp2_download' => null,
                        'wbp_download' => null,
                        'kvarh_download' => null,
                        'konsiden_download' => null,
                    );
                    $data2 = array(
                        'visual' => $visual,
                        'download' => $download
                    );

                    if($meter=="utama"){
                        $dt = array(
                            'utama'=>$update,
                            'pembanding'=> $data2,
                            'ps'=>$data2
                        );
                        $dt2 = array(
                            'utama'=>$olah,
                            'pembanding'=> null,
                            'ps'=>null
                        );
                        $dt_jual = array(
                            'total_kwh_jual'=> null
                        );
                        $dt = array(
                            'beli'=> $dt,
                            'hasil_pengolahan'=> $dt2,
                            'jual'=> $dt_jual
                        );
                    }
                    elseif($meter=="pembanding"){
                        $dt = array(
                            'utama'=>$data2,
                            'pembanding'=>$update,
                            'ps'=>$data2
                        );
                        $dt2 = array(
                            'utama'=>null,
                            'pembanding'=>$olah,
                            'ps'=>null
                        );
                        $dt_jual = array(
                            'total_kwh_jual'=> null
                        );
                        $dt = array(
                            'beli'=> $dt,
                            'hasil_pengolahan'=> $dt2,
                            'jual'=> $dt_jual
                        );
                    }
                    elseif($meter=="ps"){
                        $dt = array(
                            'utama'=>$data2,
                            'pembanding'=>$data2,
                            'ps'=>$update
                        );
                        $dt2 = array(
                            'utama'=>null,
                            'pembanding'=>null,
                            'ps'=>$olah
                        );
                        $dt_jual = array(
                            'total_kwh_jual'=> null
                        );
                        $dt = array(
                            'beli'=> $dt,
                            'hasil_pengolahan'=> $dt2,
                            'jual'=> $dt_jual
                        );
                    }
//                    elseif($meter=="impor"){
//                        $dt = array(
//                            'impor'=>$update,
//                            'ekspor'=>null,
//                            'lokasi'=> null
//                        );
//                        $dt2 = array(
//                            'impor'=>null,
//                            'ekspor'=>$olah,
//                            'lokasi'=> null
//                        );
//                        $dt = array(
//                            'beli'=> $dt,
//                            'hasil_pengolahan'=> $dt2
//                        );
//                    }
//                    elseif($meter=="ekspor"){
//                        $dt = array(
//                            'impor'=>null,
//                            'ekspor'=>$update,
//                            'lokasi'=> null
//                        );
//                        $dt2 = array(
//                            'impor'=>$olah,
//                            'ekspor'=>null,
//                            'lokasi'=> null
//                        );
//                        $dt = array(
//                            'beli'=> $dt,
//                            'hasil_pengolahan'=> $dt2
//                        );
//                    }
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
                            'hasil_pengolahan'=> $dt2,
                            'jual'=>$akhir['jual']
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
                            'hasil_pengolahan'=> $dt2,
                            'jual'=>$akhir['jual']
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
                            'hasil_pengolahan'=> $dt2,
                            'jual'=>$akhir['jual']
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

        }
        else{
            if($jual){
                if($akhir)
                    $akhir = json_decode($akhir->data,true);
                else $akhir = $this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali,0);
                $dt_jual = array(
                    'total_kwh_jual'=> $kwh_jual
                );
                $dt = array(
                    'beli'=> $akhir['beli'],
                    'hasil_pengolahan'=> $akhir['hasil_pengolahan'],
                    'jual'=> $dt_jual
                );
            }
            else{
                if($lalu)$dt = $this->json_dt($lalu,$visual,$download,$tipe,$meter,$faktor_kali,1);
                else $dt = $this->json_dt($awal,$visual,$download,$tipe,$meter,$faktor_kali,0);
            }
        }
        return $dt;
    }

    public function json_dt($data_awal,$visual,$download,$tipe,$meter,$faktor_kali, $lalu )
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
        if($tipe == "penyulang") $tu_visual = $visual['tu_visual'];
        elseif($tipe == "trafo_gi") $konsiden_visual = $visual['konsiden_visual'];

        if($tipe == "penyulang")
            $data_visual = array(
                'lwbp1_visual' => $lwbp1_visual,
                'lwbp2_visual' => $lwbp2_visual,
                'wbp_visual' => $wbp_visual,
                'kvarh_visual' => $kvarh_visual,
                'tu_visual' => $tu_visual,
            );
        elseif($tipe == "trafo_gi")
            $data_visual = array(
                'lwbp1_visual' => $lwbp1_visual,
                'lwbp2_visual' => $lwbp2_visual,
                'wbp_visual' => $wbp_visual,
                'kvarh_visual' => $kvarh_visual,
                'konsiden_visual' => $konsiden_visual,
            );
        else
            $data_visual = array(
                'lwbp1_visual' => $lwbp1_visual,
                'lwbp2_visual' => $lwbp2_visual,
                'wbp_visual' => $wbp_visual,
                'kvarh_visual' => $kvarh_visual,
            );
//            dd($data_awal);
        if($boolean){
            if($tipe=="trafo_gi"||$tipe=="pct"){
                if($lalu){
                    $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli'][$meter]['visual']['lwbp1_visual'])*$faktor_kali;
                    $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli'][$meter]['visual']['lwbp2_visual'])*$faktor_kali;
                    $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli'][$meter]['visual']['wbp_visual'])*$faktor_kali;
                    $kvarh_visual = ($data_visual['kvarh_visual'])*$faktor_kali;
//                  if($tipe=="trafo_gi") $konsiden_visual = ($data_visual['konsiden_visual'] - $data_awal['beli'][$meter]['visual']['konsiden_visual'])*$faktor_kali;

                }
                else{
                    $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli'][$meter]['visual']['lwbp1_visual'])*$faktor_kali;
                    $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli'][$meter]['visual']['lwbp2_visual'])*$faktor_kali;
                    $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli'][$meter]['visual']['wbp_visual'])*$faktor_kali;
                    $kvarh_visual = ($data_visual['kvarh_visual'] - $data_awal['beli'][$meter]['visual']['kvarh_visual'])*$faktor_kali;
//                  if($tipe=="trafo_gi") $konsiden_visual = ($data_visual['konsiden_visual'] - $data_awal['beli'][$meter]['visual']['konsiden_visual'])*$faktor_kali;
                }
            }
            else{
                if($lalu){
                    $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli']['visual']['lwbp1_visual'])*$faktor_kali;
                    $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli']['visual']['lwbp2_visual'])*$faktor_kali;
                    $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli']['visual']['wbp_visual'])*$faktor_kali;
                    $kvarh_visual = ($data_visual['kvarh_visual'])*$faktor_kali;
//                if($tipe=="penyulang")$tu_visual = ($data_visual['tu_visual'] - $data_awal['beli']['visual']['tu_visual'])*$faktor_kali;
                }
                else{
                    $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli']['visual']['lwbp1_visual'])*$faktor_kali;
                    $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli']['visual']['lwbp2_visual'])*$faktor_kali;
                    $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli']['visual']['wbp_visual'])*$faktor_kali;
                    $kvarh_visual = ($data_visual['kvarh_visual'] - $data_awal['beli']['visual']['kvarh_visual'])*$faktor_kali;
//                if($tipe=="penyulang")$tu_visual = ($data_visual['tu_visual'] - $data_awal['beli']['visual']['tu_visual'])*$faktor_kali;
                }
             }
        }
        else{
            $lwbp1_visual=null;
            $lwbp2_visual=null;
            $wbp_visual=null;
            $kvarh_visual=null;
            if($tipe=="trafo_gi") $konsiden_visual=null;
            elseif($tipe=="penyulang") $tu_visual=null;
        }

        if($tipe=="trafo_gi")
            $data_visual2 = array(
                'lwbp1_visual' => $lwbp1_visual,
                'lwbp2_visual' => $lwbp2_visual,
                'wbp_visual' => $wbp_visual,
                'kvarh_visual' => $kvarh_visual,
                'konsiden_visual' => $konsiden_visual,
                'total_pemakaian_kwh_visual' => $lwbp1_visual + $lwbp2_visual + $wbp_visual
            );
        elseif($tipe=="penyulang")
            $data_visual2 = array(
                'lwbp1_visual' => $lwbp1_visual,
                'lwbp2_visual' => $lwbp2_visual,
                'wbp_visual' => $wbp_visual,
                'kvarh_visual' => $kvarh_visual,
                'tu_visual' => $tu_visual,
                'total_pemakaian_kwh_visual' => $lwbp1_visual + $lwbp2_visual + $wbp_visual
            );
        else
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
        if($tipe == "trafo_gi")  $konsiden_download = $download['konsiden_download'];
        elseif($tipe == "penyulang") $tu_download = $download['tu_download'];

        if($tipe == "penyulang")
            $data_download = array(
                'lwbp1_download' => $lwbp1_download,
                'lwbp2_download' => $lwbp2_download,
                'wbp_download' => $wbp_download,
                'kvarh_download' => $kvarh_download,
                'tu_download' => $tu_download,
            );
        elseif($tipe == "trafo_gi")
            $data_download = array(
                'lwbp1_download' => $lwbp1_download,
                'lwbp2_download' => $lwbp2_download,
                'wbp_download' => $wbp_download,
                'kvarh_download' => $kvarh_download,
                'konsiden_download' => $konsiden_download,
            );
        else
            $data_download = array(
                'lwbp1_download' => $lwbp1_download,
                'lwbp2_download' => $lwbp2_download,
                'wbp_download' => $wbp_download,
                'kvarh_download' => $kvarh_download,
            );

        if($boolean){
            if($tipe=="trafo_gi"||$tipe=="pct"){
                if($lalu){
                    if($meter=="utama"||$meter=="ps"){
                        $lwbp1_download = ($download['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
                    }
                    else{
                        $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli'][$meter]['download']['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli'][$meter]['download']['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download'] - $data_awal['beli'][$meter]['download']['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
//                  if($tipe == "trafo_gi") $konsiden_download = ($download['konsiden_download'] - $data_awal['beli'][$meter]['download']['konsiden_download']);
                    }
                }
                else{
                    if($meter=="utama"||$meter=="ps"){
                        $lwbp1_download = ($download['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
                    }
                    else{
                        $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli'][$meter]['download']['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli'][$meter]['download']['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download'] - $data_awal['beli'][$meter]['download']['wbp_download']);
                        $kvarh_download = ($download['kvarh_download'] - $data_awal['beli'][$meter]['download']['kvarh_download']);
//                  if($tipe == "trafo_gi") $konsiden_download = ($download['konsiden_download'] - $data_awal['beli'][$meter]['download']['konsiden_download']);
                    }
                }
            }
            else{
                if($lalu) {
                    if($meter=="utama"||$meter=="ps"){
                        $lwbp1_download = ($download['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download']);
                        $wbp_download = ($download['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
                    }
                    else{
                        $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli']['download']['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli']['download']['lwbp2_download']);
                        $wbp_download = ($download['wbp_download'] - $data_awal['beli']['download']['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
                    }
                }
                else{
                    if($meter=="utama"||$meter=="ps"){
                        $lwbp1_download = ($download['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download']);
                        $kvarh_download = ($download['kvarh_download']);
                    }
                    else{
                        $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli']['download']['lwbp1_download']);
                        $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli']['download']['lwbp2_download']);
                        $wbp_download =  ($download['wbp_download'] - $data_awal['beli']['download']['wbp_download']);
                        $kvarh_download = ($download['kvarh_download'] - $data_awal['beli']['download']['kvarh_download']);
//                    if($tipe == "penyulang") $tu_download = ($download['tu_download'] - $data_awal['beli']['download']['tu_download']);
                    }
                }

            }
        }
        else{
            $lwbp1_download=null;
            $lwbp2_download=null;
            $wbp_download=null;
            $kvarh_download=null;
            if($tipe == "trafo") $konsiden_download=null;
            elseif($tipe == "penyulang") $tu_download=null;
        }

        if($tipe == "penyulang")
            $data_download2 = array(
                'lwbp1_download' => $lwbp1_download,
                'lwbp2_download' => $lwbp2_download,
                'wbp_download' => $wbp_download,
                'kvarh_download' => $kvarh_download,
                'total_pemakaian_kwh_download' => $lwbp1_download + $lwbp2_download + $wbp_download

            );
        elseif($tipe == "trafo_gi")
            $data_download2 = array(
                'lwbp1_download' => $lwbp1_download,
                'lwbp2_download' => $lwbp2_download,
                'wbp_download' => $wbp_download,
                'kvarh_download' => $kvarh_download,
                'konsiden_download' => $konsiden_download,
                'total_pemakaian_kwh_download' => $lwbp1_download + $lwbp2_download + $wbp_download
            );
        else
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
        $dt_jual = array(
            'total_kwh_jual'=> null
        );

        $dt = array(
            'beli' => $data,
            'hasil_pengolahan' => $data_pengolahan,
            'jual' => $dt_jual
        );
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

    public function list_laporan_gardu($id_gardu){
        $data = PenyimpananGI::where('id_gi', $id_gardu)->get();
        return view('admin.nonmaster.listrik.hasil_pengolahan', [
            'data'            => $data
        ]);
    }

    public function input_data($id,$tipe){

        if(date("m")<3){
            if(date("m")==1){
                $date_prev = (date("Y")-1)."11";
                $date_now =  (date("Y")-1)."12";
            }
            else{
                $date_prev = (date("Y") - 1) . "12";
                $date_now = date("Ym") - 1;}
        }else{
            $date_prev = (date("Ym")-2);
            $date_now = date("Ym")-1;
        }

        if($tipe=="gi"){
            $data = PenyimpananGI::where('periode',$date_now)->where('id_gi', $id)->first();
            $jenis = GI::where('id',$id)->first();
        }
        elseif($tipe=="trafo_gi"){
            $data = PenyimpananTrafoGI::where('periode',$date_now)->where('id_trafo_gi', $id)->first();
            $data_lalu = PenyimpananTrafoGI::where('periode',$date_prev)->where('id_trafo_gi', $id)->first();
            $data_lalu2 = PenyimpananTrafoGI::where('periode',"L".$date_prev)->where('id_trafo_gi', $id)->first();
            $jenis = TrafoGI::where('id',$id)->first();
        }
        elseif($tipe=="penyulang"){
            $data = PenyimpananPenyulang::where('periode',$date_now)->where('id_penyulang', $id)->first();
            $data_lalu = PenyimpananPenyulang::where('periode',$date_prev)->where('id_penyulang', $id)->first();
            $data_lalu2 = PenyimpananPenyulang::where('periode',"L".$date_prev)->where('id_penyulang', $id)->first();
            $jenis = Penyulang::where('id',$id)->first();
        }
        elseif($tipe=="pct"){
            $data = PenyimpananGardu::where('periode',$date_now)->where('id_gardu', $id)->first();
            $jenis = Gardu::where('id',$id)->first();
            $data_lalu = $data_lalu2 = null;
        }
        elseif($tipe=="gd" || $tipe=="tm"){
            $data = PenyimpananGardu::where('periode',$date_now)->where('id_gardu', $id)->first();
            $jenis = Gardu::where('id',$id)->first();
            $data_lalu = $data_lalu2 = null;
        }

//        dd($data);
        if($data_lalu2){
            $dt = null;
            $dt2 = json_decode($data_lalu2->data, true);
        }
        elseif($data_lalu){
            $dt = json_decode($data_lalu->data, true);
            $dt2 = null;
        }
        else{
            $dt=$dt2=null;
        }
//        dd($dt2);

        if($data){
            $data = json_decode($data->data, true);
        }
        else {

            $data_visual = array(
                'lwbp1_visual' => null,
                'lwbp2_visual' => null,
                'wbp_visual' => null,
                'kvarh_visual' => null,
                'tu_visual' => null,
                'konsiden_visual' => null
            );

            $data_download = array(
                'lwbp1_download' => null,
                'lwbp2_download' => null,
                'wbp_download' => null,
                'kvarh_download' => null,
                'tu_download' => null,
                'konsiden_download' => null
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
                $meter_visual = array(
                    'awal_visual' => null,
                    'akhir_visual' => null,
                );
                $meter_download = array(
                    'total_kwh_download' => null,
                );
                $dt_m =array(
                    'visual' => $meter_visual,
                    'download' => $meter_download,
                );
                $dt_meter =array(
                    'impor' => $dt_m,
                    'ekspor' => $dt_m,
                );
                $dt_h = array(
                    'total_kwh_visual' => null,
                    'total_kwh_download' => null,
                );
                $dt_hasil = array(
                    'impor' => $dt_h,
                    'ekspor' => $dt_h,
                );
                $m = array(
                    'beli' => $dt_meter,
                    'hasil_pengolahan' => $dt_hasil,
                );

            }
            if($tipe=="pct"){
                $data=$m;
            }
            else{
                $data =array(
                    'beli'=>$data_awal,
                    'hasil_pengolahan'=> null,
                    'jual'=> null,
                );
            }
//            $hasil = json_encode($data);
//            $data = json_decode($hasil, true);
        }
        $decoded = json_decode($jenis->data_master,true);
        $data_GI = array();
        $fk =array();
        if($tipe=="trafo_gi"){
            $id = TrafoGI::select('id_organisasi','id_gi','data_master')->where("id",$id)->first();
            $fk['utama'] = (json_decode($id->data_master,true)['utama']['FK']['faktorkali']);
            $fk['pembanding'] = (json_decode($id->data_master,true)['pembanding']['FK']['faktorkali']);
            $fk['ps'] = (json_decode($id->data_master,true)['ps']['FK']['faktorkali']);

        }
        elseif($tipe=="penyulang"){
            $id = Penyulang::where("id",$id)->first();
            $fk['utama'] = (json_decode($id->data_master,true)['FK']['faktorkali']);
            $id = TrafoGI::select('id_organisasi','id_gi')->where("id",$id->id_trafo_gi)->first();
        }
        elseif($tipe=="pct"){
            $fk_ = Gardu::select('data_master')->where('id',$id)->first();
            $fk['utama'] = json_decode($fk_->data_master,true)['meter']['FK']['faktorkali'];
            $id = Penyulang::where("id",$id)->first();
            $id = Organisasi::select('id_organisasi','id')->where("id",Auth::user()->id)->first();
        }
        $data_GI['id_gi'] =$id-> id_gi;
        $data_GI['id_rayon'] = $id['id_organisasi'];
        $data_GI['tipe'] ="rayon";
//        dd($fk);
        $home = new HomeController;
        $date = $home->MonthShifter(-2)->format(('M Y'));
        $date2 = $home->MonthShifter(-1)->format(('M Y'));
        return view('admin.nonmaster.dashboard_user.input_data', [
            'data_GI'            => $data_GI,
            'date'            => $date,
            'date2'            => $date2,
            'data'            => $data,
            'dt'              => $dt,
            'fk'              => $fk,
            'dt2'             => $dt2,
            'decoded'         => $decoded,
            'jenis'           => $jenis,
            'tipe'            => $tipe
        ]);
    }
}