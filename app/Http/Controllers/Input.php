<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\PenyimpananGardu;
use App\PenyimpananPenyulang;
use App\Penyulang;
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
        $data = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->get();
        return view('admin.nonmaster.dashboard_user.list_gardu',[
            'data' =>$data
        ]);
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

    public function list_gardu($id_rayon){
        $data = Gardu::where('id_organisasi', $id_rayon)->get();
        return view('admin.nonmaster.dashboard_user.list_gardu',[
            'data' =>$data
        ]);
    }

    public function list_penyulang($id_gardu){
        $data = Penyulang::where('id_gardu', $id_gardu)->get();
        return view('admin.nonmaster.dashboard_user.gardu',[
            'data' =>$data,
            'gardu' =>$id_gardu
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
        $data_listrik = PenyimpananGardu::where('periode', date('Ym'))->where('id_gardu', $request->id_gardu)->first();
//
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

        if($data_listrik){
            $data=$this->olah_data($input_visual,$input_download,$request->id_gardu);
            return view('admin.nonmaster.listrik.hasil_pengolahan', [
                'data'            => $data
            ]);
        }
        else{
            $data = array(
                'visual' => $input_visual,
                'download' => $input_download
            );

            $PGardu = new PenyimpananGardu();
            $PGardu->id_gardu = $request->id_gardu;
            $PGardu->periode = date('Ym');
            $PGardu->data = json_encode($data);
            if($PGardu->save()){
                $data = PenyimpananGardu::where('id_gardu', $request->id_gardu)->get();
                return view('admin.nonmaster.listrik.hasil_pengolahan', [
                    'data'            => $data
                ]);
                echo "berhasil";
            }
            else
                echo "gagal";
        }

//
//        if ($data_listrik) {
//            if ($request->tipe == 'jual') {
//                $data = json_decode($data_listrik->data, true);
//
//                $data_visual = array(
//                    'lwbp1_visual' => $data['beli']['visual']['lwbp1_visual'],
//                    'lwbp2_visual' => $data['beli']['visual']['lwbp2_visual'],
//                    'wbp_visual' => $data['beli']['visual']['wbp_visual'],
//                    'kvarh_visual' => $data['beli']['visual']['kvarh_visual']
//                );
//
//                $data_download = array(
//                    'lwbp1_download' => $data['beli']['download']['lwbp1_download'],
//                    'lwbp2_download' => $data['beli']['download']['lwbp2_download'],
//                    'wbp_download' => $data['beli']['download']['wbp_download'],
//                    'kvarh_download' => $data['beli']['download']['kvarh_download']
//                );
//                $data_beli = array(
//                    'visual' => $data_visual,
//                    'download' => $data_download);
//
//                $data_jual = array(
//                    'visual' => $input_visual,
//                    'download' => $input_download);
//
//            }
//            elseif ($request->tipe == 'beli') {
//
//                $data = json_decode($data_listrik->data, true);
//                $data_visual = array(
//                    'lwbp1_visual' => $data['jual']['visual']['wbp1_visual'],
//                    'lwbp2_visual' => $data['jual']['visual']['lwbp2_visual'],
//                    'wbp_visual' => $data['jual']['visual']['wbp_visual'],
//                    'kvarh_visual' => $data['jual']['visual']['kvarh_visual']
//                );
//
//                $data_download = array(
//                    'lwbp1_download' => $data['jual']['download']['wbp1_download'],
//                    'lwbp2_download' => $data['jual']['download']['lwbp2_download'],
//                    'wbp_download' => $data['jual']['download']['wbp_download'],
//                    'kvarh_download' => $data['jual']['download']['kvarh_download']
//                );
//                $data_jual = array(
//                    'visual' => $data_visual,
//                    'download' => $data_download);
//                $data_beli = array(
//                    'visual' => $input_visual,
//                    'download' => $input_download);
//
//            }
//
//            $dt = array(
//                'jual' => $data_jual,
//                'beli' => $data_beli);
//
//            $data_listrik->data = json_encode($dt);
//            if ($data_listrik->save()) ;
//        }
//        else {
//            $data_visual = array(
//                'lwbp1_visual' => null,
//                'lwbp2_visual' => null,
//                'wbp_visual' => null,
//                'kvarh_visual' => null
//            );
//
//            $data_download = array(
//                'lwbp1_download' => null,
//                'lwbp2_download' => null,
//                'wbp_download' => null,
//                'kvarh_download' => null
//            );
//            if ($request->tipe == 'jual') {
//                $data_beli = array(
//                    'visual' => $data_visual,
//                    'download' => $data_download);
//
//                $data_jual = array(
//                    'visual' => $input_visual,
//                    'download' => $input_download);
//            }
//            else {
//                $data_jual = array(
//                    'visual' => $data_visual,
//                    'download' => $data_download);
//
//                $data_beli = array(
//                    'visual' => $input_visual,
//                    'download' => $input_download);
//            }
//            $dt = array(
//                'jual' => $data_jual,
//                'beli' => $data_beli);
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
//
//            $this->olah_data();
//        }
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
        $data = Listrik::where('id_organisasi', Auth::user()->id_organisasi)->get();
        return view('admin.nonmaster.listrik.list_data', [
            'data'            => $data
        ]);
    }

    public function input_data($id_penyulang){

        $data = PenyimpananPenyulang::where('id_penyulang', Auth::user()->id_penyulang)->get();
        return view('admin.nonmaster.dashboard_user.input_data_dummy', [
            'data'            => $id_penyulang
        ]);
    }

    public function input_gardu($id_gardu){

        $data = PenyimpananGardu::where('periode',date('Ym'))->where('id_gardu', $id_gardu)->first();
        $gardu = Gardu::where('id',$id_gardu)->first();
        $data_awal = json_decode($data->data, true);

        return view('admin.nonmaster.dashboard_user.input_data_dummy', [
            'data'            => $data_awal,
            'gardu'            => $gardu
        ]);
    }

    public function olah_data($visual,$download,$id_gardu){
        $faktor_kali = 1;
        $date = date('Ym')- "1";
        $awal = PenyimpananGardu::where('periode', $date)->where('id_gardu', $id_gardu)->first();

//        $awal = PenyimpananGardu::select('id', 'periode', 'data')->orderBy('id', 'desc')->limit(1)->offset(1)->where('id_organisasi',Auth::user()->id_organisasi)->first();
//        $akhir = Listrik::select('id', 'tahun_bulan', 'data')->orderBy('id', 'desc')->limit(1)->where('id_organisasi',Auth::user()->id_organisasi)->first();
        $data_awal = json_decode($awal->data, true);
//        $data_akhir = json_decode($akhir->data, true);

        $lwbp1_visual = ($visual['lwbp1_visual'] - $data_awal['visual']['lwbp1_visual'])*$faktor_kali;
        $lwbp2_visual = ($visual['lwbp2_visual'] - $data_awal['visual']['lwbp2_visual'])*$faktor_kali;
        $wbp_visual = ($visual['wbp_visual'] - $data_awal['visual']['wbp_visual'])*$faktor_kali;
        $kvarh_visual = ($visual['kvarh_visual'] - $data_awal['visual']['kvarh_visual'])*$faktor_kali;

        $data_visual = array(
            'lwbp1_visual' => $lwbp1_visual,
            'lwbp2_visual' => $lwbp2_visual,
            'wbp_visual' => $wbp_visual,
            'kvarh_visual' => $kvarh_visual,
            'total_pemakaian_kwh_visual' => $lwbp1_visual + $lwbp2_visual + $wbp_visual
        );

        $lwbp1_download = ($download['lwbp1_download'] - $data_awal['download']['lwbp1_download'])*$faktor_kali;
        $lwbp2_download = ($download['lwbp2_download'] - $data_awal['download']['lwbp2_download'])*$faktor_kali;
        $wbp_download =  ($download['wbp_download'] - $data_awal['download']['wbp_download'])*$faktor_kali;
        $kvarh_download = ($download['kvarh_download'] - $data_awal['download']['kvarh_download'])*$faktor_kali;

        $data_download = array(
            'lwbp1_download' => $lwbp1_download,
            'lwbp2_download' => $lwbp2_download,
            'wbp_download' => $wbp_download,
            'kvarh_download' => $kvarh_download,
            'total_pemakaian_kwh_visual' => $lwbp1_download + $lwbp2_download + $wbp_download

        );

        $data = array(
                'visual' => $data_visual,
                'download' => $data_download );

//        $dt = array(
//                'jual' => $data,
//                'beli' => null );
//
        $hasil = PenyimpananGardu::where('periode', date('Ym'))->where('id_gardu',$id_gardu)->first();
        $hasil->data = json_encode($data);
        if($hasil->save()){
            $dt = PenyimpananGardu::where('id_gardu', $id_gardu )->get();
            return $dt;
        }

    }


}
