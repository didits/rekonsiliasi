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
        elseif($request->penyulang){

            $inputPenyulang = new TrafoGI;
            $id_org = Organisasi::where('id_organisasi',$request->id_org)->first();
            $inputPenyulang->id_organisasi = $id_org->id;
            $inputPenyulang->id_gi = $request->penyulang;
            $inputPenyulang->nama_trafo_gi = $request->tambahnamapenyulang;
            $inputPenyulang->alamat_trafo_gi = $request->tambahalamatpenyulang;
            $inputPenyulang->data_master="";
            if($inputPenyulang->save());

            $rayon = Organisasi::where('id_organisasi', $request->idrayon)->first();
            $gardu = GI::where('id', $request->idgardu)->first();
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
        else{

            if($request->formpenyulang)
                $data = TrafoGI::where('id',$request->formpenyulang)->first();
            else $data = GI::where('id',$request->idgardu)->first();
            if( $data ){
                $decoded = json_decode($data->data_master, true);
//            dd($decoded);
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

            if($request->formpenyulang)
                $data_master = TrafoGI::where('id', $request->formpenyulang)->first();
            else $data_master = GI::where('id', $request->idgardu)->first();
            $data_master->data_master=json_encode($data);
            if($data_master->save());

            if($request->formpenyulang)
                $data = TrafoGI::where('id', $request->formpenyulang)->first();
            else $data = GI::where('id', $request->idgardu)->first();
            $decoded = json_decode($data->data_master, true);
            return view('admin.nonmaster.dashboard_user.datamaster',[
                'data' => $decoded,
                'idgardu'=>$request->idgardu,
                'idpenyulang'=>$request->formpenyulang
            ]);
        }

    }

    public function list_rayon(){
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data]);
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
        $data = TrafoGI::where('id', $id_gardu_induk)->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster_trafo_gi',[
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
}
