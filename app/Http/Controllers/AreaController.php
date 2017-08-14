<?php

namespace App\Http\Controllers;
use App\Gardu;
use App\GI;
use App\Organisasi;
use App\TrafoGI;
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

    public function store(Request $request){
        if($request->id_organisasi){
            $inputGardu = new GI;
            $id_org = Organisasi::where('id_organisasi', $request->id_organisasi)->get();
            $inputGardu->id_organisasi = $id_org[0]->id;
            $inputGardu->nama_gi = $request->tambahnamagardu;
            $inputGardu->alamat_gi = $request->tambahalamatgardu;
            $inputGardu->data_master="";

            if($inputGardu->save());
            $data = GI::where('id_organisasi', $id_org[0]->id)->get();
            $nama_rayon = Organisasi::where('id_organisasi', $request->id_organisasi)->get();
            $nama_rayon = $nama_rayon[0]->nama_organisasi;

            return view('admin.nonmaster.dashboard_user.list_datamaster_rayon',[
                'data' =>$data,
                'id_organisasi'=>$request->id_organisasi,
                'nama_rayon' =>$nama_rayon
            ]);


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

            $rayon = Organisasi::where('id_organisasi', $request->idrayon)->first();
            $gardu = GI::where('id', $request->idgardu)->first();
//            dd($request->idgardu);
            $data = TrafoGI::where('id_gi', $gardu->id)->get();
            $decoded = json_decode($gardu->data_master, true);
            return view('admin.nonmaster.dashboard_user.datamaster_gardu_induk',[
                'data' =>$data,
                'decoded' =>$decoded,
                'gardu'=>$gardu,
                'idgardu'=>$request->idgardu,
                'rayon'=>$rayon,
                'id_org'=>$request->id_org,
            ]);
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

            $rayon = Organisasi::where('id_organisasi', $request->idrayon)->first();
            $trafogi = TrafoGI::where('id', $request->idtrafo_gi)->first();
            $data = Penyulang::where('id_trafo_gi', $trafogi->id)->get();
            $decoded = json_decode($trafogi->data_master, true);
            return view('admin.nonmaster.dashboard_user.datamaster_trafo_gi',[
                'data' =>$data,
                'decoded' =>$decoded,
                'trafo_gi'=>$trafogi,
                'id_trafo_gi'=>$request->idtrafo_gi,
                'rayon'=>$rayon,
                'id_org'=>$request->id_org,
            ]);
        }
        elseif($request->GD){

            $inputGardu = new Gardu;
            $id_org = Organisasi::where('id_organisasi',$request->id_org)->first();
            $inputGardu->id_organisasi = $id_org->id;
            $inputGardu->id_penyulang = $request->GD;
            $inputGardu->nama_gardu = $request->tambahnamagardu;
            $inputGardu->alamat_gardu = $request->tambahalamatgardu;
            $inputGardu->data_master="";

            if($inputGardu->save());

            $rayon = Organisasi::where('id_organisasi', $request->idrayon)->first();
            $penyulang = Penyulang::where('id', $request->idpenyulang)->first();
            $data = Gardu::where('id_penyulang', $penyulang->id)->get();
            $decoded = json_decode($penyulang->data_master, true);
            return view('admin.nonmaster.dashboard_user.datamaster_penyulang',[
                'data' =>$data,
                'decoded' =>$decoded,
                'penyulang'=>$penyulang,
                'id_penyulang'=>$request->idpenyulang,
                'rayon'=>$rayon,
                'id_org'=>$request->id_org,
            ]);
        }
        else{
            $data="";
            if($request->form_trafogi)
                $data = TrafoGI::where('id',$request->form_trafogi)->first();
            elseif($request->form_gi)
                $data = GI::where('id',$request->idgardu)->first();
            elseif($request->form_penyulang)
                $data = Penyulang::where('id',$request->form_penyulang)->first();
            elseif($request->form_gardu)
                $data = Gardu::where('id',$request->form_gardu)->first();
            if($data ){
                $decoded = json_decode($data->data_master, true);
                if($request->tipe ==    'KWH'){
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
            $data_master = "";
            if($request->form_trafogi)
                $data_master = TrafoGI::where('id', $request->form_trafogi)->first();
            elseif($request->form_gi)
                $data_master = GI::where('id', $request->idgardu)->first();
            elseif($request->form_penyulang)
                $data_master = Penyulang::where('id',$request->form_penyulang)->first();
            elseif($request->form_gardu)
                $data_master = Gardu::where('id',$request->form_gardu)->first();
            $data_master->data_master=json_encode($data);
            if($data_master->save());

            $type = "";
            if($request->form_gi){
                $data = GI::where('id', $request->idgardu)->first();
                $type=0;
            }
            elseif($request->form_trafogi){
                $data = TrafoGI::where('id', $request->form_trafogi)->first();
                $type=1;
            }
            elseif($request->form_penyulang){
                $data = Penyulang::where('id',$request->form_penyulang)->first();
                $type=2;
            }
            elseif($request->form_gardu){
                $data = Gardu::where('id',$request->form_gardu)->first();
                $type=3;
            }
            $rayon = Organisasi::where('id', $data->id_organisasi)->first();
            $decoded = json_decode($data->data_master, true);
            return view('admin.nonmaster.dashboard_user.datamaster',[
                'data' => $decoded,
                'type'=>$type,
                'tipe'=>$data,
                'idgardu'=>$request->idgardu,
                'idpenyulang'=>$request->form_trafogi,
                'rayon'=>$rayon
            ]);
        }

    }

    public function list_rayon(){
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'list_distribusi' => $this->list_distribusi()]);
//            'id' => $data->id_organisasi]);
    }

    public function list_gardu_induk($id_rayon){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $data = GI::where('id_organisasi', $id_org)->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster_gi',[
            'data' =>$data,
            'id_organisasi'=>$id_rayon,
            'nama_rayon' =>$nama_rayon
            ]);
    }

    public function list_trafo_gi($id_rayon, $id_gardu_induk){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $data = TrafoGI::where('id_gi', $id_gardu_induk)->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster_trafo_gi',[
            'data' =>$data,
            'id_organisasi'=>$id_rayon,
            'nama_rayon' =>$nama_rayon
        ]);
    }

    public function list_penyulang($id_rayon, $id_trafo_gi){
        $rayon = Organisasi::where('id_organisasi', $id_rayon)->get();
        $nama_rayon = $rayon[0]->nama_organisasi;
        $id_org = $rayon[0]->id;
        $data = Penyulang::where('id_trafo_gi', $id_trafo_gi)->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster_penyulang',[
            'data' =>$data,
            'id_organisasi'=>$id_rayon,
            'nama_rayon' =>$nama_rayon
        ]);
    }

    public function lihat_gi($id_organisasi, $id_gardu_induk){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $gardu = GI::where('id', $id_gardu_induk)->first();
        $data = TrafoGI::where('id_gi', $id_gardu_induk)->get();
        $decoded = json_decode($gardu->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_gardu_induk',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gardu'=>$gardu,
            'idgardu'=>$id_gardu_induk,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            ]);
    }

    public function lihat_trafo_gi($id_organisasi, $id_trafo_gi){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $trafo_gi = TrafoGI::where('id', $id_trafo_gi)->first();
        $data = Penyulang::where('id_trafo_gi', $id_trafo_gi)->get();
//        dd($data);
        $decoded = json_decode($trafo_gi->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_trafo_gi',[
            'data' =>$data,
            'decoded' =>$decoded,
            'trafo_gi'=>$trafo_gi,
            'id_trafo_gi'=>$id_trafo_gi,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function lihat_penyulang($id_organisasi, $id_penyulang){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $penyulang = Penyulang::where('id', $id_penyulang)->first();
        $data = Gardu::where('id_penyulang', $id_penyulang)->get();
//        dd($penyulang);
        $decoded = json_decode($penyulang->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster_penyulang',[
            'data' =>$data,
            'decoded' =>$decoded,
            'penyulang'=>$penyulang,
            'id_penyulang'=>$id_penyulang,
            'rayon'=>$rayon,
            'id_org'=>$id_organisasi,
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
    public function datamaster()
    {
        $data = Gardu::where('id_organisasi', Auth::user()->id_organisasi)->first();
        $decoded = json_decode($data->data_master, true);
        return view('admin.nonmaster.dashboard_user.datamaster',[
            'data' => $decoded]);
    }

    public function list_distribusi()
    {
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
            $gi[] = GI::select('id', 'id_organisasi', 'nama_gi', 'alamat_gi')
                ->where('id_organisasi', $idr)
                ->get();
            $j = 0;
            foreach ($gi[$i] as $gis) {
                $gi[$i][$j]['trafo_gi'] = TrafoGI::select('id', 'id_organisasi', 'id_gi', 'nama_trafo_gi', 'alamat_trafo_gi')
                    ->where('id_gi', $gis->id)
                    ->get();
                $k = 0;
                foreach ($gi[$i][$j]['trafo_gi'] as $trafogi) {
                    $gi[$i][$j]['trafo_gi'][$k]['penyulang'] = Penyulang::select('id', 'id_organisasi', 'id_trafo_gi', 'nama_penyulang', 'alamat_penyulang')
                        ->where('id_trafo_gi', $trafogi->id)
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
}
