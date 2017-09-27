<?php

namespace App\Http\Controllers;
use App\Gardu;
use App\GI;
use App\Organisasi;
use App\TrafoGI;
use App\Transfer;
use Auth;
use Illuminate\Http\Request;
use App\Penyulang;

class AreaController extends Controller
{ 
    protected $id_role;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_role = Auth::user()->tipe_organisasi;
            if(!$this->id_role==2)
                return redirect('/login')->with('status', [
                'enabled'       => true,
                'type'          => 'danger',
                'content'       => 'Tidak boleh mengakses'
            ]);
            return $next($request);
        });
    }

    public function getStructureKelistrikan($id_organisasi){
        $nama_rayon = Organisasi::find($id_organisasi);
        $area = array('name' => $nama_rayon->nama_organisasi, 'title' => '', 'children' => '', 'office' => 'Rayon ');
        for ($h=0; $h < 1; $h++) { 
            $gi = GI::where('id_organisasi', $id_organisasi)->get(array('nama_gi as name','alamat_gi as title', 'id as id'))->toArray();
            $gi_array = array();
            for ($i=0; $i < count($gi); $i++) { 
                $trafo_gi = TrafoGI::where('id_organisasi', $id_organisasi)->where('id_gi',$gi[$i]['id'])->get(array('nama_trafo_gi as name','alamat_trafo_gi as title', 'id as id'))->toArray();
                $trafo_gi_array = array();
                for ($j=0; $j < count($trafo_gi); $j++) {
                    $penyulang = Penyulang::where('id_organisasi', $id_organisasi)->where('id_trafo_gi', $trafo_gi[$j]['id'])->get(array('nama_penyulang as name','alamat_penyulang as title', 'id as id'))->toArray();
                    $penyulang_array = array();
                    for ($k=0; $k < count($penyulang); $k++) {
                        $gardu = Gardu::where('id_organisasi', $id_organisasi)->where('id_penyulang', $penyulang[$k]['id'])->get(array('nama_gardu as name','alamat_gardu as title', 'tipe_gardu as tipe_gardu'))->toArray();
                        $semua_gardu = array();

                        $gardu_array = array();
                        for ($l=0; $l < count($gardu); $l++) { 
                            if($gardu[$l] && $gardu[$l]['tipe_gardu']==0)
                                array_push($gardu_array,array('name' => $gardu[$l]['name'], 'title' => $gardu[$l]['title'], 'office' => ''));
                        }
                        $penyulang_array_gd = array('name' => 'GD', 'title' => 'GD', 'children' => $gardu_array, 'office' => 'GD');
                        if($gardu_array)
                        array_push($semua_gardu,$penyulang_array_gd);

                        $gardu_array = array();
                        for ($l=0; $l < count($gardu); $l++) { 
                            if($gardu[$l] && $gardu[$l]['tipe_gardu']==1)
                                array_push($gardu_array,array('name' => $gardu[$l]['name'], 'title' => $gardu[$l]['title'], 'office' => ''));
                        }
                        $penyulang_array_pct = array('name' => 'PCT', 'title' => 'PCT', 'children' => $gardu_array, 'office' => 'PCT');
                        if($gardu_array)
                        array_push($semua_gardu,$penyulang_array_pct);

                        $gardu_array = array();
                        for ($l=0; $l < count($gardu); $l++) { 
                            if($gardu[$l] && $gardu[$l]['tipe_gardu']==2)
                                array_push($gardu_array,array('name' => $gardu[$l]['name'], 'title' => $gardu[$l]['title'], 'office' => ''));

                        }
                        $penyulang_array_tm = array('name' => 'TM', 'title' => 'TM', 'children' => $gardu_array, 'office' => 'TM');
                        if($gardu_array)
                        array_push($semua_gardu,$penyulang_array_tm);

                        
                        $penyulang_array_ = array('name' => $penyulang[$k]['name'], 'title' => $penyulang[$k]['name'], 'children' => $semua_gardu, 'office' => 'Penyulang');
                        if($penyulang_array_)
                        array_push($penyulang_array,$penyulang_array_);
                    }


                    if($penyulang_array)
                        $trafo_gi_array_ = array('name' => $trafo_gi[$j]['name'], 'title' => $trafo_gi[$j]['title'], 'children' => $penyulang_array, 'office' => 'Trafo GI');
                    else
                        $trafo_gi_array_ = array('name' => $trafo_gi[$j]['name'], 'title' => $trafo_gi[$j]['title'], 'office' => 'Trafo GI');
                    array_push($trafo_gi_array,$trafo_gi_array_);
                }

                if($trafo_gi_array)
                    $gi_array_ = array('name' => $gi[$i]['name'], 'title' => $gi[$i]['title'], 'children' => $trafo_gi_array, 'office' => 'GI');
                else
                    $gi_array_ = array('name' => $gi[$i]['name'], 'title' => $gi[$i]['title'], 'office' => 'GI');
                array_push($gi_array,$gi_array_);
            }
            $area['children'] = $gi_array;
        }

        return view('admin.nonmaster.dashboard_user.structure_organization',[
            'data' => json_encode($area)]);
    }

    public function index()
    {
//        $data = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->first();
//        if(!empty ( $data )){
//            return view('admin.nonmaster.dashboard_user.index');
//        }

    }

    public function create(Request $request){
//        dd($request->id_organisasi);
//        $input_visual = array(
//            'lwbp1_visual' => $request->lwbp1_visual,
//            'lwbp2_visual' => $request->lwbp2_visual,
//            'wbp_visual' => $request->wbp_visual,
//            'kvarh_visual' => $request->kvarh_visual
//        );
//
//        $input_download = array(
//            'lwbp1_download' => $request->lwbp1_download,
//            'lwbp2_download' => $request->lwbp2_download,
//            'wbp_download' => $request->wbp_download,
//            'kvarh_download' => $request->kvarh_download
//        );
        echo "slam";
    }

    public function delete($id_organisasi,$tipe, $id){
        if($tipe=="GD")
           Gardu::where('id',$id)->delete();
        return back();
    }

    public function store(Request $request){
        if($request->id_organisasi){
            $inputGardu = new GI;
            $id_org = Organisasi::where('id_organisasi', $request->id_organisasi)->get();
            $inputGardu->id_organisasi = $id_org[0]->id;
            $inputGardu->nama_gi = $request->tambahnamagardu;
            $inputGardu->alamat_gi = $request->tambahalamatgardu;
            $inputGardu->data_master="";

            if($inputGardu->save());
            return back();
        }
        elseif($request->trafogi){
            $inputTrafoGI = new TrafoGI;
            $id_org = Organisasi::where('id_organisasi',$request->id_org)->first();
            $inputTrafoGI->id_organisasi = $id_org->id;
            $inputTrafoGI->id_gi = $request->trafogi;
            $inputTrafoGI->nama_trafo_gi = $request->tambahnamatrafogi;
            $inputTrafoGI->alamat_trafo_gi = $request->tambahalamattrafogi;
            $inputTrafoGI->data_master="";
            if($inputTrafoGI->save());
            return back();
        }
        elseif($request->penyulang){
            $inputPenyulang = new Penyulang;
            $id_org = Organisasi::where('id_organisasi',$request->id_org)->first();
            $inputPenyulang->id_organisasi = $id_org->id;
            $inputPenyulang->id_trafo_gi = $request->penyulang;
            $inputPenyulang->nama_penyulang = $request->tambahnamapenyulang;
            $inputPenyulang->alamat_penyulang = $request->tambahalamatpenyulang;
            $inputPenyulang->data_master="";
            if($inputPenyulang->save());
            $penyulang = Penyulang::where('id_organisasi',$id_org->id)->orderBy('updated_at', 'desc')->first();

            if($id_org->id_organisasi == $request->selectrayonsingle);
            else{
                $id_gi = TrafoGI::where('id_organisasi',$id_org->id)->first();
                $id_org_des = Organisasi::where('id_organisasi',$request->selectrayonsingle)->first();
//                dd($id_org_des);
                $transfer = new Transfer;
                $transfer->id_organisasi = $id_org_des->id;
                $transfer->id_gi = $id_gi->id_gi;
                $transfer->id_trafo_gi = $penyulang->id_trafo_gi;
                $transfer->id_penyulang = $penyulang->id;
                if($transfer->save());
            }

            return back();
        }
        elseif($request->GD){
            $inputGardu = new Gardu;
            $id_org = Organisasi::where('id',$request->id_org)->first();
            $inputGardu->id_organisasi = $id_org->id;
            $inputGardu->id_penyulang = $request->GD;
            $inputGardu->nama_gardu = $request->tambahnamagardu;
            $inputGardu->alamat_gardu = $request->tambahalamatgardu;
            $inputGardu->data_master = "";
            $inputGardu->tipe_gardu=$request->tipe_;

            if($inputGardu->save());
            return back();
        }
        else{
            $data="";
            $dt="";
            if($request->form_trafogi)
                $data = TrafoGI::where('id',$request->form_trafogi)->first();
            elseif($request->form_gi)
                $data = GI::where('id',$request->idgardu)->first();
            elseif($request->form_penyulang)
                $data = Penyulang::where('id',$request->form_penyulang)->first();
            elseif($request->form_gardu)
                $data = Gardu::where('id',$request->form_gardu)->first();
//            dd($request->form_gardu);
            if($data->id_gi){
                if($request->form_utama){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",1),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",0),
                        'ps' => $this->json_datamaster($request, $data, "ps",0)
                    );
                }
                elseif ($request->form_pembanding){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",0),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",1),
                        'ps' => $this->json_datamaster($request, $data, "ps",0)
                    );
                }
                elseif ($request->form_ps){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",0),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",0),
                        'ps' => $this->json_datamaster($request, $data, "ps",1)
                    );
                }
            }
            elseif($data->tipe_gardu == 1 ){
                if($request->form_editExim){
                    $area = Organisasi::where('id_organisasi', $request->selectareasingle)->first();
                    $rayon = Organisasi::where('id_organisasi', $request->selectrayonsingle)->first();
                    $penyulang = Penyulang::where('id', $request->selectpenyulangsingle)->first();
                    $penyulang2 = Penyulang::where('id', $request->gardu)->first();
                    $lok_d = array(
                        'area' => $request->area,
                        'rayon' => $request->rayon,
                        'penyulang' =>$penyulang2->nama_penyulang
                    );
                    $lok_t = array(
                        'area' => $area->nama_organisasi,
                        'rayon' => $rayon->nama_organisasi,
                        'penyulang' =>$penyulang->nama_penyulang
                    );
                    $lok = array(
                        'impor' => $lok_d,
                        'ekspor' => $lok_t
                    );
                }
                else{
                    $decoded = json_decode($data->data_master, true);
                    $lok_d = array(
                        'area' => $decoded['lokasi']['impor']['area'],
                        'rayon' => $decoded['lokasi']['impor']['rayon'],
                        'penyulang' =>$decoded['lokasi']['impor']['penyulang']
                    );
                    $lok_t = array(
                        'area' => $decoded['lokasi']['ekspor']['area'],
                        'rayon' => $decoded['lokasi']['ekspor']['rayon'],
                        'penyulang' =>$decoded['lokasi']['ekspor']['penyulang']
                    );
                    $lok = array(
                        'impor' => $lok_d,
                        'ekspor' => $lok_t
                    );
                }
                $dat = $this->json_datamaster($request, $data, "meter",1);
                $data = array(
                    'meter' => $dat,
                    'lokasi'=> $lok
                );
            }
            else{
                $data = $this->json_dm($request, $data);
            }

            $data_master = "";
            if($request->form_trafogi)
                $data_master = TrafoGI::where('id', $request->form_trafogi)->first();
            elseif($request->form_gi)
                $data_master = GI::where('id', $request->idgardu)->first();
            elseif($request->form_penyulang)
                $data_master = Penyulang::where('id',$request->form_penyulang)->first();
            elseif($request->form_gardu)
                $data_master = Gardu::where('id',$request->form_gardu)->first();
            $data_master->data_master = json_encode($data);
            $data_master->save();
            return back()->withInput();
        }
    }

    public function json_dm($request,$data){
        if($data ){
            $decoded = json_decode($data->data_master, true);
            if($request->tipe == 'all'){
                $data_KWH = array(
                    'merk' => $request->merk,
                    'nomorseri' => $request->noseri,
                    'konstanta' => $request->konstanta,
                    'teganganarus' => $request->teganganarus
                );
                $data_TA = array(
                    'ratioct' => $request->ratioct,
                    'burdenct' => $request->burdenct
                );
                $data_TT = array(
                    'ratiopt' => $request->ratiopt,
                    'burdenpt' => $request->burdenpt
                );
                $data_FK = array(
                    'faktorkali' => $request->faktorkali
                );
            }
            elseif($request->tipe == 'KWH'){
                $data_KWH = array(
                    'merk' => $request->merk,
                    'nomorseri' => $request->noseri,
                    'konstanta' => $request->konstanta,
                    'teganganarus' => $request->teganganarus
                );
                $data_TA = array(
                    'ratioct' => $decoded['TA']['ratioct'],
                    'burdenct' => $decoded['TA']['burdenct']
                );
                $data_TT = array(
                    'ratiopt' => $decoded['TT']['ratiopt'],
                    'burdenpt' => $decoded['TT']['burdenpt']
                );
                $data_FK = array(
                    'faktorkali' => $decoded['FK']['faktorkali']
                );
            }
            else if($request->tipe == 'TA'){
                $data_KWH = array(
                    'merk' => $decoded['KWH']['merk'],
                    'nomorseri' => $decoded['KWH']['nomorseri'],
                    'konstanta' => $decoded['KWH']['konstanta'],
                    'teganganarus' => $decoded['KWH']['teganganarus']
                );

                $data_TA = array(
                    'ratioct' => $request->ratioct,
                    'burdenct' => $request->burdenct
                );
                $data_TT = array(
                    'ratiopt' => $decoded['TT']['ratiopt'],
                    'burdenpt' => $decoded['TT']['burdenpt']
                );

                $data_FK = array(
                    'faktorkali' => $decoded['FK']['faktorkali']
                );
            }
            else if($request->tipe == 'TT'){
                $data_KWH = array(
                    'merk' => $decoded['KWH']['merk'],
                    'nomorseri' => $decoded['KWH']['nomorseri'],
                    'konstanta' => $decoded['KWH']['konstanta'],
                    'teganganarus' => $decoded['KWH']['teganganarus']
                );

                $data_TA = array(
                    'ratioct' => $decoded['TA']['ratioct'],
                    'burdenct' => $decoded['TA']['burdenct']
                );
                $data_TT = array(
                    'ratiopt' => $request->ratiopt,
                    'burdenpt' => $request->burdenpt
                );

                $data_FK = array(
                    'faktorkali' => $decoded['FK']['faktorkali']
                );
            }
            else if($request->tipe == 'FK'){
                $data_KWH = array(
                    'merk' => $decoded['KWH']['merk'],
                    'nomorseri' => $decoded['KWH']['nomorseri'],
                    'konstanta' => $decoded['KWH']['konstanta'],
                    'teganganarus' => $decoded['KWH']['teganganarus']
                );

                $data_TA = array(
                    'ratioct' => $decoded['TA']['ratioct'],
                    'burdenct' => $decoded['TA']['burdenct']
                );
                $data_TT = array(
                    'ratiopt' => $decoded['TT']['ratiopt'],
                    'burdenpt' => $decoded['TT']['burdenpt']
                );

                $data_FK = array(
                    'faktorkali' => $request->faktorkali
                );
            }

            if($request->tipe == 'GI') {
                $data = array(
                    'APP' => $request->APP,
                    'kapasitas' => $request->kapasitas);
            }
            else{
                $data = array(
                    'KWH' => $data_KWH,
                    'TA' => $data_TA,
                    'TT' => $data_TT,
                    'FK' => $data_FK );
            }

        }
        else {
            if($request->tipe == 'all') {
                $data_KWH = array(
                    'merk' => $request->merk,
                    'nomorseri' => $request->noseri,
                    'konstanta' => $request->konstanta,
                    'teganganarus' => $request->teganganarus
                );
                $data_TA = array(
                    'ratioct' => $request->ratioct,
                    'burdenct' => $request->burdenct
                );

                $data_TT = array(
                    'ratiopt' => $request->ratiopt,
                    'burdenpt' => $request->burdenpt
                );

                $data_FK = array(
                    'faktorkali' => $request->faktorkali
                );
            }

            elseif($request->tipe == 'KWH'){
                $data_KWH = array(
                    'merk' => $request->merk,
                    'nomorseri' => $request->noseri,
                    'konstanta' => $request->konstanta,
                    'teganganarus' => $request->teganganarus
                );
                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );

                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => null
                );

            }
            else if($request->tipe == 'TA'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => $request->ratioct,
                    'burdenct' => $request->burdenct
                );

                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => null
                );
            }
            else if($request->tipe == 'TT'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );

                $data_TT = array(
                    'ratiopt' => $request->ratiopt,
                    'burdenpt' => $request->burdenpt
                );

                $data_FK = array(
                    'faktorkali' => null
                );
            }
            else if($request->tipe == 'FK'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );
                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => $request->faktorkali
                );
            }
            if($request->tipe == 'GI') {
                $data = array(
                    'APP' => $request->APP,
                    'kapasitas' => $request->kapasitas);
            }
            else{
                $data = array(
                    'KWH' => $data_KWH,
                    'TA' => $data_TA,
                    'TT' => $data_TT,
                    'FK' => $data_FK );
            }

        }
        return $data;
    }

    public function json_datamaster($request,$data,$meter,$action)
    {
        if($data ){
            $decoded = json_decode($data->data_master, true);
            if($request->tipe == 'all') {
                if($action){
                    $data_KWH = array(
                        'merk' => $request->merk,
                        'nomorseri' => $request->noseri,
                        'konstanta' => $request->konstanta,
                        'teganganarus' => $request->teganganarus
                    );
                    $data_TA = array(
                        'ratioct' => $request->ratioct,
                        'burdenct' => $request->burdenct
                    );
                    $data_TT = array(
                        'ratiopt' => $request->ratiopt,
                        'burdenpt' => $request->burdenpt
                    );
                    $data_FK = array(
                        'faktorkali' => $request->faktorkali
                    );
                }else{
                    if($request->form_exim||$request->form_exim_||$request->form_editExim){
                        $data_KWH = array(
                            'merk' => $decoded['meter'][$meter]['KWH']['merk'],
                            'nomorseri' => $decoded['meter'][$meter]['KWH']['nomorseri'],
                            'konstanta' => $decoded['meter'][$meter]['KWH']['konstanta'],
                            'teganganarus' => $decoded['meter'][$meter]['KWH']['teganganarus']
                        );
                        $data_TA = array(
                            'ratioct' => $decoded['meter'][$meter]['TA']['ratioct'],
                            'burdenct' => $decoded['meter'][$meter]['TA']['burdenct']
                        );
                        $data_TT = array(
                            'ratiopt' => $decoded['meter'][$meter]['TT']['ratiopt'],
                            'burdenpt' => $decoded['meter'][$meter]['TT']['burdenpt']
                        );
                        $data_FK = array(
                            'faktorkali' => $decoded['meter'][$meter]['FK']['faktorkali']
                        );
                    }
                    else{
                        $data_KWH = array(
                            'merk' => $decoded[$meter]['KWH']['merk'],
                            'nomorseri' => $decoded[$meter]['KWH']['nomorseri'],
                            'konstanta' => $decoded[$meter]['KWH']['konstanta'],
                            'teganganarus' => $decoded[$meter]['KWH']['teganganarus']
                        );
                        $data_TA = array(
                            'ratioct' => $decoded[$meter]['TA']['ratioct'],
                            'burdenct' => $decoded[$meter]['TA']['burdenct']
                        );
                        $data_TT = array(
                            'ratiopt' => $decoded[$meter]['TT']['ratiopt'],
                            'burdenpt' => $decoded[$meter]['TT']['burdenpt']
                        );
                        $data_FK = array(
                            'faktorkali' => $decoded[$meter]['FK']['faktorkali']
                        );
                    }
                }
            }
            elseif($request->tipe == 'KWH'){
               if($action){
                   $data_KWH = array(
                       'merk' => $request->merk,
                       'nomorseri' => $request->noseri,
                       'konstanta' => $request->konstanta,
                       'teganganarus' => $request->teganganarus
                   );
               }else{
                   $data_KWH = array(
                       'merk' => $decoded[$meter]['KWH']['merk'],
                       'nomorseri' => $decoded[$meter]['KWH']['nomorseri'],
                       'konstanta' => $decoded[$meter]['KWH']['konstanta'],
                       'teganganarus' => $decoded[$meter]['KWH']['teganganarus']
                   );
                }

               $data_TA = array(
                    'ratioct' => $decoded[$meter]['TA']['ratioct'],
                    'burdenct' => $decoded[$meter]['TA']['burdenct']
                );

                $data_TT = array(
                    'ratiopt' => $decoded[$meter]['TT']['ratiopt'],
                    'burdenpt' => $decoded[$meter]['TT']['burdenpt']
                );

                $data_FK = array(
                    'faktorkali' => $decoded[$meter]['FK']['faktorkali']
                );

            }
            else if($request->tipe == 'TA'){
                $data_KWH = array(
                    'merk' => $decoded[$meter]['KWH']['merk'],
                    'nomorseri' => $decoded[$meter]['KWH']['nomorseri'],
                    'konstanta' => $decoded[$meter]['KWH']['konstanta'],
                    'teganganarus' => $decoded[$meter]['KWH']['teganganarus']
                );

                if($action){
                    $data_TA = array(
                        'ratioct' => $request->ratioct,
                        'burdenct' => $request->burdenct
                    );
                }else{
                    $data_TA = array(
                        'ratioct' => $decoded[$meter]['TA']['ratioct'],
                        'burdenct' => $decoded[$meter]['TA']['burdenct']
                    );
                }

                $data_TT = array(
                    'ratiopt' => $decoded[$meter]['TT']['ratiopt'],
                    'burdenpt' => $decoded[$meter]['TT']['burdenpt']
                );

                $data_FK = array(
                    'faktorkali' => $decoded[$meter]['FK']['faktorkali']
                );
            }
            else if($request->tipe == 'TT'){
                $data_KWH = array(
                    'merk' => $decoded[$meter]['KWH']['merk'],
                    'nomorseri' => $decoded[$meter]['KWH']['nomorseri'],
                    'konstanta' => $decoded[$meter]['KWH']['konstanta'],
                    'teganganarus' => $decoded[$meter]['KWH']['teganganarus']
                );

                $data_TA = array(
                    'ratioct' => $decoded[$meter]['TA']['ratioct'],
                    'burdenct' => $decoded[$meter]['TA']['burdenct']
                );

                if($action){
                    $data_TT = array(
                        'ratiopt' => $request->ratiopt,
                        'burdenpt' => $request->burdenpt
                    );
                }else{
                    $data_TT = array(
                        'ratiopt' => $decoded[$meter]['TT']['ratiopt'],
                        'burdenpt' => $decoded[$meter]['TT']['burdenpt']
                    );
                }

                $data_FK = array(
                    'faktorkali' => $decoded[$meter]['FK']['faktorkali']
                );
            }
            else if($request->tipe == 'FK'){
                $data_KWH = array(
                    'merk' => $decoded[$meter]['KWH']['merk'],
                    'nomorseri' => $decoded[$meter]['KWH']['nomorseri'],
                    'konstanta' => $decoded[$meter]['KWH']['konstanta'],
                    'teganganarus' => $decoded[$meter]['KWH']['teganganarus']
                );

                $data_TA = array(
                    'ratioct' => $decoded[$meter]['TA']['ratioct'],
                    'burdenct' => $decoded[$meter]['TA']['burdenct']
                );
                $data_TT = array(
                    'ratiopt' => $decoded[$meter]['TT']['ratiopt'],
                    'burdenpt' => $decoded[$meter]['TT']['burdenpt']
                );

                if($action){
                    $data_FK = array(
                        'faktorkali' => $request->faktorkali
                    );
                }else{
                    $data_FK = array(
                        'faktorkali' => $decoded[$meter]['FK']['faktorkali']
                    );
                }
            }

            $data = array(
                'KWH' => $data_KWH,
                'TA' => $data_TA,
                'TT' => $data_TT,
                'FK' => $data_FK );

        }
        else {
            if($request->tipe == 'KWH'){
                $data_KWH = array(
                    'merk' => $request->merk,
                    'nomorseri' => $request->noseri,
                    'konstanta' => $request->konstanta,
                    'teganganarus' => $request->teganganarus
                );
                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );

                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => null
                );

            }
            else if($request->tipe == 'TA'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => $request->ratioct,
                    'burdenct' => $request->burdenct
                );

                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => null
                );
            }
            else if($request->tipe == 'TT'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );

                $data_TT = array(
                    'ratiopt' => $request->ratiopt,
                    'burdenpt' => $request->burdenpt
                );

                $data_FK = array(
                    'faktorkali' => null
                );
            }
            else if($request->tipe == 'FK'){
                $data_KWH = array(
                    'merk' => null,
                    'nomorseri' => null,
                    'konstanta' => null,
                    'teganganarus' => null
                );

                $data_TA = array(
                    'ratioct' => null,
                    'burdenct' => null
                );
                $data_TT = array(
                    'ratiopt' => null,
                    'burdenpt' => null
                );

                $data_FK = array(
                    'faktorkali' => $request->faktorkali
                );
            }

            $data = array(
                'KWH' => $data_KWH,
                'TA' => $data_TA,
                'TT' => $data_TT,
                'FK' => $data_FK );

        }

        return $data;
    }

    public function list_rayon(){
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => false, 'transaksi' => false]);
    }

    public function list_master_rayon() {
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => true, 'transaksi' => false]);
    }

    public function laporan_beli() {
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => false, 'transaksi' => true]);
    }

    public function list_gardu_induk($id_rayon){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $data = GI::where('id_organisasi', $id_org)->get();
//        dd($rayon);
        $id_ryn = Organisasi::where('id_organisasi', $id_rayon)->first();
        $data2 = Transfer::select('transfer.id_organisasi','transfer.id_gi', 'gi.nama_gi', 'gi.alamat_gi')
            ->join('GI','GI.id','=','transfer.id_gi')->distinct('transfer.id_gi')
            ->where('transfer.id_organisasi', $id_ryn->id)->get();
//        dd($data2);
        return view('admin.nonmaster.dashboard_user.list_datamaster_gi',[
            'data' =>$data,
            'data2' =>$data2,
            'id_organisasi'=>$id_rayon,
            'nama_rayon' =>$nama_rayon
        ]);
    }

    public function list_datamaster($id_rayon){
        $master_gi = new MasterGI($id_rayon);
//        dd($master_gi->data);
        return view('admin.nonmaster.dashboard_user.list_datamaster_',[
            'data' =>$master_gi->data,
            'data2' =>$master_gi->data2,
            'id_organisasi'=>$master_gi->id_rayon,
            'nama_rayon' =>$master_gi->nama_rayon,
            'laporan' => false, 'transaksi' => false
        ]);
    }

    public function list_master_gi($id_rayon){
        $master_gi = new MasterGI($id_rayon);
        return view('admin.nonmaster.dashboard_user.list_datamaster2_',[
            'data' =>$master_gi->data,
            'data2' =>$master_gi->data2,
            'tipe' => "gi",
            'id_organisasi'=>$master_gi->id_rayon,
            'nama_rayon' =>$master_gi->nama_rayon,
            'laporan' => true, 'transaksi' => false
        ]);
    }

    public function list_master($id_rayon,$tipe,$id){
        $master = new Master($id_rayon,$tipe,$id);
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
            'laporan' => true, 'transaksi' => false
        ]);
    }

    public function list_trafo_gi($id_rayon, $id_gardu_induk){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $data = TrafoGI::where('id_gi', $id_gardu_induk)->get();
        $nama_gi = GI::select('nama_gi')->where('id', $id_gardu_induk)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster_trafo_gi',[
            'data'          => $data,
            'id_organisasi' => $id_rayon,
            'nama_rayon'    => $nama_rayon,
            'nama_gi'       => $nama_gi->nama_gi
        ]);
    }

    public function list_trafo_gi_transfer($id_rayon, $id_gi){
//        dd($id_rayon);
        $rayon = Organisasi::where('id', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $data = TrafoGI::select('id','nama_trafo_gi','alamat_trafo_gi')->where('id_gi', $id_gi)->get();
        $nama_gi = GI::select('nama_gi')->where('id', $id_gi)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster_trafo_gi',[
            'data'          => $data,
            'id_organisasi' => $id_rayon,
            'nama_rayon'    => $nama_rayon,
            'nama_gi'       => $nama_gi->nama_gi
        ]);
    }

    public function list_penyulang($id_rayon, $id_trafo_gi){
        $rayon = Organisasi::select('id')->where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
//        dd($id_trafo_gi);
        $data = Transfer::where('id_trafo_gi',$id_trafo_gi)
            ->pluck('id_penyulang');
        $data2 = Penyulang::select('id','nama_penyulang','alamat_penyulang','id_trafo_gi')->whereNotIn('id',$data)
            ->where('id_trafo_gi',$id_trafo_gi)
            ->get();
        $data3 = Penyulang::select('id','nama_penyulang','alamat_penyulang')->whereIn('id',$data)
            ->get();
//        dd($data2);
        $nama_tgi = TrafoGI::select('nama_trafo_gi')->where('id', $id_trafo_gi)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster_penyulang',[
            'data'          => $data2,
            'data2'          => $data3,
            'id_organisasi' => $id_rayon,
            'nama_rayon'    => $nama_rayon,
            'nama_tgi'      => $nama_tgi->nama_trafo_gi
        ]);
    }

    public function list_penyulang_transfer($id_rayon, $id_trafo_gi){
        $rayon = Organisasi::where('id', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $data2 ="";
        $data = Transfer::select('transfer.id_organisasi','transfer.id_gi', 'penyulang.id as id','penyulang.nama_penyulang', 'penyulang.alamat_penyulang')
            ->join('Penyulang','Penyulang.id','=','transfer.id_penyulang')->distinct('transfer.id_penyulang')
            ->where('transfer.id_trafo_gi', $id_trafo_gi)->get();
//        dd($data);
        $nama_tgi = TrafoGI::select('nama_trafo_gi')->where('id', $id_trafo_gi)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster_trafo_gi',[
            'data'         => $data,
            'data2'         => $data2,
            'id_organisasi' => $id_rayon,
            'nama_rayon'    => $nama_rayon,
            'nama_gi'    => null,
            'nama_tgi'      => $nama_tgi->nama_trafo_gi
        ]);
    }

    public function lihat_gi($id_organisasi, $id_gardu_induk){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $gardu = GI::where('id', $id_gardu_induk)->first();
        $data = TrafoGI::where('id_gi', $id_gardu_induk)->get();
        $decoded = json_decode($gardu->data_master, true);
//        dd($id_organisasi);
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gi'=>$gardu,'trafo_gi'=>null,'penyulang'=>null,'gardu'=>null,
            'id_gi'=>$id_gardu_induk,'id_trafo_gi'=>null,'id_penyulang'=>null,'id_gardu'=>null,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }
    public function lihat_trafo_gi($id_organisasi, $id_trafo_gi){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $trafo_gi = TrafoGI::where('id', $id_trafo_gi)->first();
        $transfer = Transfer::where('id_trafo_gi',$id_trafo_gi)->pluck('id_penyulang');
        $data = Penyulang::select('id','nama_penyulang','data_master')
//            ->whereNotIn('id',$transfer)
            ->where('id_trafo_gi',$id_trafo_gi)
            ->get();
//        dd($data);
        $decoded = json_decode($trafo_gi->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gi'=>null,'trafo_gi'=>$trafo_gi,'penyulang'=>null,'gardu'=>null,
            'id_gi'=>null,'id_trafo_gi'=>$id_trafo_gi,'id_penyulang'=>null,'id_gardu'=>null,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function lihat_penyulang($id_organisasi, $id_penyulang){
//        dd($id_organisasi);
        if($id_organisasi[0]=="t"){
            $id_organisasi = explode('t', $id_organisasi);
            $rayon = Organisasi::where('id', $id_organisasi[1])->first();
        }
        else $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $penyulang = Penyulang::where('id', $id_penyulang)->first();
        $data = Gardu::where('id_penyulang', $id_penyulang)->get();
        $decoded = json_decode($penyulang->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gi'=>null,'trafo_gi'=>null,'penyulang'=>$penyulang,'gardu'=>null,
            'id_gi'=>null,'id_trafo_gi'=>null,'id_penyulang'=>$id_penyulang,'id_gardu'=>null,
            'rayon'=>$rayon,
            'id_org'=>$rayon->id,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function lihat_gardu($id_organisasi, $id_gardu){

        $rayon = Organisasi::where('id', $id_organisasi)->first();
        $gardu = Gardu::where('id', $id_gardu)->first();
        $data = Gardu::where('id', $id_gardu)->get();
        $decoded = json_decode($gardu->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gi'=>null,'trafo_gi'=>null,'gardu'=>$gardu,'penyulang'=>null,
            'id_gi'=>null,'id_trafo_gi'=>null,'id_gardu'=>$id_gardu,'id_penyulang'=>null,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function profil()
    {
        if (Auth::user()->tipe_organisasi == 2)
            $tipe = "AREA ";
        elseif (Auth::user()->tipe_organisasi == 3)
            $tipe = "RAYON ";
        $navhead = "PROFIL " . $tipe . Auth::user()->nama_organisasi;
        return view('admin.nonmaster.dashboard_user.profile', [
            'judul' => $navhead
        ]);
    }

    public function pemakaiansendiri()
    {
        return view('admin.nonmaster.dashboard_user.pemakaiansendiri');
    }

//    public function datamaster()
//    {
//        $data = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->first();
//        $decoded = json_decode($data->data_master, true);
//        return view('admin.nonmaster.dashboard_user.datamaster',[
//            'data' => $decoded]);
//    }

    public function list_biasa(){

        $area = Organisasi::select('id', 'id_organisasi')
            ->where('id_organisasi', Auth::user()->id_organisasi)
            ->first();

        $subarea = substr($area->id_organisasi, 0, 3) . "%%";
        $rayon = Organisasi::select('id', 'id_organisasi')
            ->where([
                ['id_organisasi', 'like', $subarea],
                ['tipe_organisasi', '!=', 2]])
            ->get();
        $id_rayon = array();
        foreach ($rayon as $arr) {
            $id_rayon[] = $arr->id;
        }
        $gi = GI::select('nama_gi','nama_gi','id','id_organisasi')
            ->whereIn('id_organisasi',$id_rayon)->get();
        $trafo = TrafoGI::select('nama_trafo_gi','id','id_organisasi')
            ->whereIn('id_organisasi',$id_rayon)->get();
        $penyulang = Penyulang::select('nama_penyulang','id','id_organisasi')
            ->whereIn('id_organisasi',$id_rayon)->get();
        $tp= array();
        array_push($tp,$gi);
        array_push($tp,$trafo);
        array_push($tp,$penyulang);

        return $tp;
    }

    public function list_distribusi()
    {
//        $aut = Auth::user()->id_organisasi;
//        $aut="11".$aut[2];
//
//        $arearayon = Organisasi::select('id','id_organisasi')
//            ->where('id_organisasi', 'like' , "%$aut%")->get();
////        dd($arearayon);
//
//        $area = Organisasi::select('id', 'id_organisasi')
//            ->where('id_organisasi', Auth::user()->id_organisasi)
//            ->first();
//
//        $subarea = substr($area->id_organisasi, 0, 3) . "%%";
//        $rayon = Organisasi::select('id', 'id_organisasi')
//            ->where([
//                ['id_organisasi', 'like', $subarea],
//                ['tipe_organisasi', '!=', 2]])
//            ->get();
//        $id_rayon = array();
//        foreach ($rayon as $arr) {
//            $id_rayon[] = $arr->id;
//        }
//        $gi = GI::select('nama_gi','nama_gi','id','id_organisasi')
//            ->whereIn('id_organisasi',$id_rayon)->get();
//        $trafo = TrafoGI::select('nama_trafo_gi','id','id_organisasi')
//            ->whereIn('id_organisasi',$id_rayon)->get();
//        $penyulang = Penyulang::select('nama_penyulang','id','id_organisasi')
//            ->whereIn('id_organisasi',$id_rayon)->get();
//        $tp= array();
//        array_push($tp,$gi);
//        array_push($tp,$trafo);
//        array_push($tp,$penyulang);
////        dd($tp);

        $area = Organisasi::select('id', 'id_organisasi')
            ->where('id_organisasi', Auth::user()->id_organisasi)
            ->first();
        $subarea = substr($area->id_organisasi, 0, 3) . "%%";
        $rayon = Organisasi::select('id', 'id_organisasi')
            ->where([
                ['id_organisasi', 'like', $subarea],
                ['tipe_organisasi', '!=', 2]])
            ->get();
        $id_rayon = array();
        foreach ($rayon as $arr) {
            $id_rayon[] = $arr->id;
        }
        $gi = array();
        $i = 0;
        foreach ($id_rayon as $idr) {
            $gi[] = GI::select('gi.id', 'organisasi.nama_organisasi', 'gi.nama_gi', 'gi.alamat_gi', 'gi.data_master')
                ->where('gi.id_organisasi', $idr)
                ->join('organisasi', 'organisasi.id', '=', 'gi.id_organisasi')
                ->get();
            $j = 0;
            foreach ($gi[$i] as $gis) {
                $gi[$i][$j]['trafo_gi'] = TrafoGI::select('trafo_gi.id', 'organisasi.nama_organisasi', 'trafo_gi.id_gi', 'trafo_gi.nama_trafo_gi', 'trafo_gi.alamat_trafo_gi', 'trafo_gi.data_master')
                    ->where('trafo_gi.id_gi', $gis->id)
                    ->join('organisasi', 'organisasi.id', '=', 'trafo_gi.id_organisasi')
                    ->get();
                $k = 0;
                foreach ($gi[$i][$j]['trafo_gi'] as $trafogi) {
                    $gi[$i][$j]['trafo_gi'][$k]['penyulang'] = Penyulang::select('penyulang.id', 'organisasi.nama_organisasi', 'penyulang.id_trafo_gi', 'penyulang.nama_penyulang', 'penyulang.alamat_penyulang', 'penyulang.data_master')
                        ->where('penyulang.id_trafo_gi', $trafogi->id)
                        ->join('organisasi', 'organisasi.id', '=', 'penyulang.id_organisasi')
                        ->get();
                    $k++;
                }
                $j++;
            }
            $i++;
        }
        return $gi;
    }

    public function populateArea()
    {
        $dropdown_area = Organisasi::select('id_organisasi', 'nama_organisasi')->where('tipe_organisasi', '=', 2)->get();
        return $dropdown_area;
    }

    public function tabel_master()
    {
        return view("admin.nonmaster.dashboard_user.laporan_master", [
            'list_distribusi' => $this->list_distribusi()]);
    }

    public function edit_datamaster(Request $request)
    {
        $edit = $request->task;
        $id = $request->id;
        $nama = $request->nama;
        $alamat = $request->alamat;

//        dd($request->alamat);

//        return $request->task;

        if ($edit == "t_gi")
            $table = TrafoGI::where('id', $id)->update(['nama_trafo_gi' => $nama, 'alamat_trafo_gi' => $alamat]);
        elseif ($edit == "penyulang")
            $table = Penyulang::where('id', $id)->update(['nama_penyulang' => $nama, 'alamat_penyulang' => $alamat]);
        elseif ($edit == "gd")
            $table = Gardu::where('id', $id)->update(['nama_gardu' => $nama, 'alamat_gardu' => $alamat]);
        elseif ($edit == "pct")
            $table = Gardu::where('id', $id)->update(['nama_gardu' => $nama, 'alamat_gardu' => $alamat]);
        elseif ($edit == "p_tm")
            $table = Gardu::where('id', $id)->update(['nama_gardu' => $nama, 'alamat_gardu' => $alamat]);

        return $table;
    }

    public function hapus_datamaster($id_organisasi,$tipe, $id)
    {
        if ($tipe == "t_gi")
            $table = TrafoGI::where('id',$id)->delete();
        elseif ($tipe == "penyulang")
            $table = Penyulang::where('id',$id)->delete();
        elseif ($tipe == "gd")
            $table = Gardu::where('id',$id)->delete();
        elseif ($tipe == "pct")
            $table = Gardu::where('id',$id)->delete();
        elseif ($tipe == "p_tm")
            $table = Gardu::where('id',$id)->delete();

        return $table;
    }

    public function view_datamaster($id_organisasi, $unit, $id_unit)
    {
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();

        if($unit=="gi"){
            $master = GI::where('id', $id_unit)->first();
            $data = TrafoGI::where('id_gi', $id_unit)->get();
        }
        elseif($unit=="tgi"){
            $master = TrafoGI::where('id', $id_unit)->first();
            $data = Penyulang::where('id_trafo_gi', $id_unit)->get();
        }
        elseif($unit=="penyulang"){
            $master = Penyulang::where('id', $id_unit)->first();
            $data = Gardu::where('id_penyulang', $id_unit)->get();
        }
        elseif($unit=="gd"){
            $master = Gardu::where('id', $id_unit)->first();
//            $data = Gardu::where('id_ga', $id_unit)->get();
            $data="";
        }
//        dd($master);

        $decoded = json_decode($master->data_master, true);
        return view("admin.nonmaster.dashboard_user.laporan_datamaster", [
            'unit' => $unit,
            'data' =>$data,
            'decoded' =>$decoded,
            'master'=>$master,
            'id_unit'=>$id_unit,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }
}