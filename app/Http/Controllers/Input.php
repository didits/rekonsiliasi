<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listrik;

class Input extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $data_visual = array(
        	'lwbp1_visual' => $request->lwbp1_visual,
        	'lwbp2_visual' => $request->lwbp2_visual,
        	'wbp_visual' => $request->wbp_visual,
        	'kvarh_visal' => $request->kvarh_visal
         );
        $data_download = array(
        	'lwbp1_download' => $request->lwbp1_download,
        	'lwbp2_download' => $request->lwbp2_download,
        	'wbp_download' => $request->wbp_download,
        	'kvarh_download' => $request->kvarh_download
         );
        $data = array(
        	'visual' => $data_visual,
        	'download' => $data_download );

        if($request->tipe == 'jual')
            $data_tipe = array('jual' => $data);
        else if($request->tipe == 'beli')
            $data_tipe = array('beli' => $data);

        $data = json_encode($data_tipe);
        $listrik = new Listrik;
        $listrik->id_organisasi = "123412";
        $listrik->tahun_bulan = "201702";
        $listrik->tipe_listrik = "penyulang";
        $listrik->data = $data_tipe;
        if($listrik->save())
        	echo "berhasil";
        else
        	echo "gagal";
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

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request)
    {
        $data_listrik = Listrik::find($id);
        $dt = array(
                'jual' => null,
                'beli' => null );

        if($data_listrik->data == null){
            $data_visual = array(
                'lwbp1_visual' => null,
                'lwbp2_visual' => null,
                'wbp_visual' => null,
                'kvarh_visal' => null
             );
            
            $data_download = array(
                'lwbp1_download' => null,
                'lwbp2_download' => null,
                'wbp_download' => null,
                'kvarh_download' => null
            );

            $data = array(
                'visual' => $data_visual,
                'download' => $data_download );

            $dt = array(
                'jual' => $data,
                'beli' => $data );
        }else $dt = (array) json_decode($data_listrik->data);

        $data_visual = array(
            'lwbp1_visual' => $request->lwbp1_visual,
            'lwbp2_visual' => $request->lwbp2_visual,
            'wbp_visual' => $request->wbp_visual,
            'kvarh_visal' => $request->kvarh_visual
         );
        
        $data_download = array(
            'lwbp1_download' => $request->lwbp1_download,
            'lwbp2_download' => $request->lwbp2_download,
            'wbp_download' => $request->wbp_download,
            'kvarh_download' => $request->kvarh_download
        );

        $data = array(
            'visual' => $data_visual,
            'download' => $data_download );

        if($request->tipe == 'jual'){
            $dt['jual'] = $data;
        }else if($request->tipe == 'beli'){
            $dt['beli'] = $data;
        }

        $listrik = Listrik::find($id);
        $listrik->id_organisasi = "123412";
        $listrik->tahun_bulan = "201702";
        $listrik->tipe_listrik = "penyulang";
        $listrik->data = json_encode($dt);
        if($listrik->save())
            echo "berhasil";
        else
            echo "gagal";

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
        $data = Listrik::all();
        return view('admin.nonmaster.listrik.list_data', [
            'data'            => $data
        ]); 
    }
}
