<?php

namespace App\Http\Controllers;
use App\DataMaster;
use App\Organisasi;
use Auth;
use Illuminate\Http\Request;
use App\Gardu;

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
//        $data = DataMaster::where('id_organisasi', Auth::user()->id_organisasi)->first();
//        if(!empty ( $data )){
            return view('admin.nonmaster.dashboard_user.index');
//        }

    }

    public function create(Request $request){
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

        $data = DataMaster::where('id_organisasi', Auth::user()->id_organisasi)->first();

        if(!empty ( $data )){
            $decoded = json_decode($data->alatpengukuran, true);
            if($request->tipe == 'KWH'){
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


            $data_master = DataMaster::where('id_organisasi', Auth::user()->id_organisasi)->first();
            $data_master->alatpengukuran=json_encode($data);
            if($data_master->save());

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


            $data_master = new DataMaster;
            $data_master->id_organisasi = Auth::user()->id_organisasi;
            $data_master->alatpengukuran = json_encode($data);
            $data_master->pembacaanmeter = json_encode(null);

            if($data_master->save());
        }
        $data = DataMaster::where('id_organisasi', Auth::user()->id_organisasi)->first();
        $decoded = json_decode($data->alatpengukuran, true);
//        return redirect('admin.nonmaster.dashboard_user.datamaster');
        return view('admin.nonmaster.dashboard_user.datamaster',[
            'data' => $decoded]);
    }

    public function list_rayon(){
        $data = Organisasi::where('id_organisasi', 'like', substr(Auth::user()->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data]);
    }

    public function list_gardu($id_rayon){
        $data = Gardu::where('id_organisasi', $id_rayon)->get();
        return view('admin.nonmaster.dashboard_user.list_datamaster_rayon',[
            'data' =>$data
            ]);
    }

    public function profil()
    {
        return view('admin.nonmaster.dashboard_user.profile');
    }

    public function pemakaiansendiri()
    {
        return view('admin.nonmaster.dashboard_user.pemakaiansendiri');
    }
    public function datamaster()
    {
        $data = DataMaster::where('id_organisasi', Auth::user()->id_organisasi)->first();
        $decoded = json_decode($data->alatpengukuran, true);
        return view('admin.nonmaster.dashboard_user.datamaster',[
            'data' => $decoded]);
    }
}
