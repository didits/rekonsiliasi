<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listrik;
use Auth;

class Input extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($tipe)
    {
        return view('admin.nonmaster.dashboard_user.input_data', [
            'tipe' => $tipe
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

    public function store(Request $request){
        echo $request->tipe;
        $dt = array(
                'jual' => null,
                'beli' => null );
        $data_visual = array(
            'lwbp1_visual' => $request->lwbp1_visual,
            'lwbp2_visual' => $request->lwbp2_visual,
            'wbp_visual' => $request->wbp_visual,
            'kvarh_visual' => $request->kvarh_visual
        );

        $data_download = array(
            'lwbp1_download' => $request->lwbp1_download,
            'lwbp2_download' => $request->lwbp2_download,
            'wbp_download' => $request->wbp_download,
            'kvarh_download' => $request->kvarh_download
        );
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

            $data = array(
                'visual' => $data_visual,
                'download' => $data_download );

            $dt = array(
                'jual' => $data,
                'beli' => $data );


//            $data = array(
//                'visual' => $data_visual,
//                'download' => $data_download );

            if($request->tipe == 'jual'){
                $dt['jual'] = $data;
            }else if($request->tipe == 'beli'){
                $dt['beli'] = $data;
            }

            $listrik = new Listrik;
            $listrik->id_organisasi = Auth::user()->id_organisasi;
            $listrik->tahun_bulan = "201702";
            $listrik->tipe_listrik = Auth::user()->tipe_organisasi;
            $listrik->data = json_encode($dt);
            if($listrik->save())
                echo "berhasil";
            else
                echo "gagal";

            $this->olah_data();
            return redirect(route('listrik.list_data'))->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
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
//            $listrik->tahun_bulan = "201702";
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

    public function olah_data(){
        $faktor_kali = 1000;
        $awal = Listrik::select('id', 'tahun_bulan', 'data')->orderBy('id', 'desc')->limit(1)->offset(1)->where('id_organisasi',Auth::user()->id_organisasi)->first();
        $akhir = Listrik::select('id', 'tahun_bulan', 'data')->orderBy('id', 'desc')->limit(1)->where('id_organisasi',Auth::user()->id_organisasi)->first();
        $data_awal = json_decode($awal->data, true);
        $data_akhir = json_decode($akhir->data, true);

        $lwbp1_visual = ($data_akhir['jual']['visual']['lwbp1_visual'] - $data_awal['jual']['visual']['lwbp1_visual'])*$faktor_kali;
        $lwbp2_visual = ($data_akhir['jual']['visual']['lwbp2_visual'] - $data_awal['jual']['visual']['lwbp2_visual'])*$faktor_kali;
        $wbp_visual = ($data_akhir['jual']['visual']['wbp_visual'] - $data_awal['jual']['visual']['wbp_visual'])*$faktor_kali;
        $kvarh_visual = ($data_akhir['jual']['visual']['kvarh_visual'] - $data_awal['jual']['visual']['kvarh_visual'])*$faktor_kali;

        $data_visual = array(
            'lwbp1_visual' => $lwbp1_visual,
            'lwbp2_visual' => $lwbp2_visual,
            'wbp_visual' => $wbp_visual,
            'kvarh_visual' => $kvarh_visual,
            'total_pemakaian_kwh_visual' => $lwbp1_visual + $lwbp2_visual + $wbp_visual
        );

        $lwbp1_download = ($data_akhir['jual']['download']['lwbp1_download'] - $data_awal['jual']['download']['lwbp1_download'])*$faktor_kali;
        $lwbp2_download = ($data_akhir['jual']['download']['lwbp2_download'] - $data_awal['jual']['download']['lwbp2_download'])*$faktor_kali;
        $wbp_download =  ($data_akhir['jual']['download']['wbp_download'] - $data_awal['jual']['download']['wbp_download'])*$faktor_kali;
        $kvarh_download = ($data_akhir['jual']['download']['kvarh_download'] - $data_awal['jual']['download']['kvarh_download'])*$faktor_kali;

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

        $dt = array(
                'jual' => $data,
                'beli' => null );

        $hasil = Listrik::where('id',$akhir->id.'')->first();
        $hasil->hasil = json_encode($dt);
        $hasil->save();
    }

    public function hasil_pengolahan(){
        $data = Listrik::where('id_organisasi', Auth::user()->id_organisasi)->get();
        return view('admin.nonmaster.listrik.hasil_pengolahan', [
            'data'            => $data
        ]); 
    }
}
