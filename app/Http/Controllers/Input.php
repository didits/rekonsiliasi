<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\GI;
use App\Organisasi;
use App\PenyimpananGI;
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

        if($request->tipe=="gardu"){
            $data_listrik = PenyimpananGI::where('periode', date('Ym'))->where('id_gardu', $request->id)->first();
        }
        else {
            $data_listrik = PenyimpananTrafoGI::where('periode', date('Ym'))->where('id_trafo_gi', $request->id)->first();
        }

        if($data_listrik){
            $data = $this->olah_data($input_visual, $input_download, $request->id, $request->tipe);
            return view('admin.nonmaster.listrik.hasil_pengolahan', [
                'data'            => $data
            ]);
        }
        else{
            $data = array(
                'visual' => $input_visual,
                'download' => $input_download
            );

            $dt =array(
                'beli'=>$data,
                'hasil pengolahan'=> null
            );
            if($request->tipe=="gardu") {
                $P = new PenyimpananGI();
                $P->id_gardu = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
            }
            else{
                $P = new PenyimpananTrafoGI();
                $P->id_trafo_gi = $request->id;
                $P->periode = date('Ym');
                $P->data = json_encode($dt);
            }
            if($P->save()){
                if($request->tipe=="gardu")
                    $data = PenyimpananGI::where('id_gardu', $request->id)->get();
                else
                    $data = PenyimpananTrafoGI::where('id_trafo_gi', $request->id)->get();
                return view('admin.nonmaster.listrik.hasil_pengolahan', [
                    'data'            => $data
                ]);
                echo "berhasil";
            }
            else
                echo "gagal";
        }

//        return redirect(route('listrik.list_data'))->with('status', [
//            'enabled'       => true,
//            'type'          => 'success',
//            'content'       => 'Berhasil login!'
//        ]);

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
        $data = PenyimpananGI::where('id_gardu', $id_gardu)->get();
        return view('admin.nonmaster.listrik.hasil_pengolahan', [
            'data'            => $data
        ]);
    }

    public function input_data($id,$tipe){

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
                'hasil pengolahan'=> null
            );
            $hasil = json_encode($data);

            $data = json_decode($hasil, true);
        }

//        dd($data);
        return view('admin.nonmaster.dashboard_user.input_data_dummy', [
            'data'            => $data,
            'jenis'           => $jenis,
            'tipe'            => $tipe
        ]);
    }

    public function olah_data($visual,$download,$id,$tipe){
        $date = date('Ym')- "1";
        $boolean_ada_data_awal = true; 
        $data_master = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->first();
        $data_master = json_decode($data_master->data_master, true);

        $faktor_kali = (int)$data_master['FK']['faktorkali'];
        
        if($tipe=="gardu")
            $awal = PenyimpananGI::where('periode', $date)->where('id_gardu', $id)->first();
        else
            $awal = PenyimpananTrafoGI::where('periode', $date)->where('id_trafo_gi', $id)->first();
        if($awal){
            $boolean_ada_data_awal = true;
            $data_awal = json_decode($awal->data, true);
        }else {
            $boolean_ada_data_awal = false;
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

        if($boolean_ada_data_awal){
            $lwbp1_visual = ($data_visual['lwbp1_visual'] - $data_awal['beli']['visual']['lwbp1_visual'])*$faktor_kali;
            $lwbp2_visual = ($data_visual['lwbp2_visual'] - $data_awal['beli']['visual']['lwbp2_visual'])*$faktor_kali;
            $wbp_visual = ($data_visual['wbp_visual'] - $data_awal['beli']['visual']['wbp_visual'])*$faktor_kali;
            $kvarh_visual = ($data_visual['kvarh_visual'] - $data_awal['beli']['visual']['kvarh_visual'])*$faktor_kali;
        }else{
            $lwbp1_visual = ($data_visual['lwbp1_visual'])*$faktor_kali;
            $lwbp2_visual = ($data_visual['lwbp2_visual'])*$faktor_kali;
            $wbp_visual = ($data_visual['wbp_visual'])*$faktor_kali;
            $kvarh_visual = ($data_visual['kvarh_visual'])*$faktor_kali;
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
            'total_pemakaian_kwh_visual' => $lwbp1_download + $lwbp2_download + $wbp_download
        );

        if($boolean_ada_data_awal){
            $lwbp1_download = ($download['lwbp1_download'] - $data_awal['beli']['download']['lwbp1_download'])*$faktor_kali;
            $lwbp2_download = ($download['lwbp2_download'] - $data_awal['beli']['download']['lwbp2_download'])*$faktor_kali;
            $wbp_download =  ($download['wbp_download'] - $data_awal['beli']['download']['wbp_download'])*$faktor_kali;
            $kvarh_download = ($download['kvarh_download'] - $data_awal['beli']['download']['kvarh_download'])*$faktor_kali;
        }else{
            $lwbp1_download = ($download['lwbp1_download'] )*$faktor_kali;
            $lwbp2_download = ($download['lwbp2_download'] )*$faktor_kali;
            $wbp_download =  ($download['wbp_download'] )*$faktor_kali;
            $kvarh_download = ($download['kvarh_download'] )*$faktor_kali;
        }


        $data_download2 = array(
            'lwbp1_download' => $lwbp1_download,
            'lwbp2_download' => $lwbp2_download,
            'wbp_download' => $wbp_download,
            'kvarh_download' => $kvarh_download,
            'total_pemakaian_kwh_visual' => $lwbp1_download + $lwbp2_download + $wbp_download

        );
        $data = array(
            'visual' => $data_visual,
            'download' => $data_download );
        $data_pengolahan = array(
                'visual' => $data_visual2,
                'download' => $data_download2 );

        $dt = array(
                'beli' => $data,
                'hasil pengolahan' => $data_pengolahan );

        if($tipe=="gardu")
            $hasil = PenyimpananGI::where('periode', date('Ym'))->where('id_gardu',$id)->first();
        else
            $hasil = PenyimpananTrafoGI::where('periode', date('Ym'))->where('id_trafo_gi',$id)->first();
        $hasil->data = json_encode($dt);

        if($hasil->save()){
            if($tipe=="gardu")
                $data = PenyimpananGI::where('id_gardu', $id )->get();
            else
                $data = PenyimpananTrafoGI::where('id_trafo_gi', $id )->get();
            return $data;
        }

    }


}
