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
            $inputGardu->tujuan=0;
            $inputGardu->asal=0;
            $inputGardu->rincian="";
            if($inputGardu->save());
            return back();
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

            $data_master = "";
            if($request->form_trafogi)
                $data_master = TrafoGI::where('id', $request->form_trafogi)->first();
            elseif($request->form_gi)
                $data_master = GI::where('id', $request->idgardu)->first();
            elseif($request->form_penyulang)
                $data_master = Penyulang::where('id',$request->form_penyulang)->first();
            elseif($request->form_gardu)
                $data_master = Gardu::where('id',$request->form_gardu)->first();


            if($request->form_trafogi){
//                dd(json_decode($data['data_master'],true));
                if($request->form_kapasitas) {
                    $data_tk = array(
                        'tegangan' => $request->tegangan,
                        'kapasitas' => $request->kapasitas,
                    );
                }
                else{
                    $data_tk = array(
                        'tegangan' => json_decode($data['data_master'],true)['kapasitas']['tegangan'],
                        'kapasitas' => json_decode($data['data_master'],true)['kapasitas']['kapasitas'],
                    );
                }
                if($request->form_kapasitas){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",0),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",0),
                        'ps' => $this->json_datamaster($request, $data, "ps",0),
                        'kapasitas' => $data_tk
                    );
                }
                elseif($request->form_utama){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",1),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",0),
                        'ps' => $this->json_datamaster($request, $data, "ps",0),
                        'kapasitas' => $data_tk
                    );
                }
                elseif ($request->form_pembanding){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",0),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",1),
                        'ps' => $this->json_datamaster($request, $data, "ps",0),
                        'kapasitas' => $data_tk
                    );
                }
                elseif ($request->form_ps){
                    $data = array(
                        'utama' => $this->json_datamaster($request, $data, "utama",0),
                        'pembanding' => $this->json_datamaster($request, $data, "pembanding",0),
                        'ps' => $this->json_datamaster($request, $data, "ps",1),
                        'kapasitas' => $data_tk
                    );
                }
            }
            elseif($data->tipe_gardu == 1 ){
                if($request->form_editExim){
                    $area = Organisasi::where('id_organisasi', $request->selectareasingle)->first();
                    $rayon_tujuan = Organisasi::where('id_organisasi', $request->selectrayonsingle)->first();
                    $id_asal = Transfer::select('id_organisasi as id_org','id')->where('id_penyulang',$request->gardu)->first();
                    if($id_asal);
                    else{
                        $id_asal = Penyulang::select('id_organisasi as id_org','id')->where('id',$request->gardu)->first();
                    }
                    $asal_rayon = Organisasi::where('id',$id_asal->id_org)->first();
                    $asal_area = Organisasi::where('id_organisasi', 'like', substr($asal_rayon->id_organisasi, 0, 3).'%')->where('tipe_organisasi', '2')->first();
                    $asal_area = $asal_area;

                    $penyulang = Penyulang::where('id', $request->selectpenyulangsingle)->first();
                    $penyulang2 = Penyulang::where('id', $id_asal->id)->first();
                    $trafo = TrafoGI::where('id',$penyulang2->id_trafo_gi)->first();
                    $GI = GI::where('id',$trafo->id_gi)->first();
                    $antar_unit = $asal_rayon->nama_organisasi ." - ".  $rayon_tujuan->nama_organisasi;
                    $lok_d = array(
                        'area' => $asal_area->nama_organisasi,
                        'rayon' => $asal_rayon->nama_organisasi,
                        'penyulang' =>$penyulang2->nama_penyulang
                    );
                    $lok_t = array(
                        'area' => $area->nama_organisasi,
                        'rayon' => $rayon_tujuan->nama_organisasi,
                        'penyulang' =>$penyulang->nama_penyulang
                    );
                    $lok = array(
                        'impor' => $lok_d,
                        'ekspor' => $lok_t
                    );
                    $rincian = array(
                        'gi' => $GI->nama_gi,
                        'penyulang' => $penyulang2->nama_penyulang,
                        'antar_unit' =>$antar_unit,
                        'lokasi_antar_unit' =>$lok,
                    );

                    $data_master->rincian = json_encode($rincian);
                    $data_master->tujuan = $rayon_tujuan->id;
                    $data_master->asal = $id_asal->id_org;
                }
                else{
//                    dd("dsad");
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
//            dd($data);
            $data_master->data_master = json_encode($data);
            if($data_master->save());
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
            if($request->tipe == 'GI')
                $data = array(
                    'APP' => $request->APP,
                    'kapasitas' => $request->kapasitas
                );
            else
                $data = array(
                    'KWH' => $data_KWH,
                    'TA' => $data_TA,
                    'TT' => $data_TT,
                    'FK' => $data_FK
                );

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
            elseif($request->tipe == 'TA'){
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
            elseif($request->tipe == 'TT'){
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
            elseif($request->tipe == 'FK'){
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
            else if($request->tipe == 'tegangan'){
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
            $data = array(
                'KWH' => $data_KWH,
                'TA' => $data_TA,
                'TT' => $data_TT,
                'FK' => $data_FK
            );
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
            else if($request->tipe == 'tegangan'){
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
                    'faktorkali' => null
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
        $data_org = Organisasi::select('id', 'id_organisasi', 'nama_organisasi')->where('id_organisasi', Auth::user()->id_organisasi)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'data_org' => $data_org,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => false, 'transaksi' => false]);
    }

    public function laporan_beli() {
        return $this->list_rayon_laporan_beli(Auth::user()->id_organisasi);
    }

    public function laporan_belis($id_org) {
        return $this->list_rayon_laporan_beli($id_org);
    }

    public function list_rayon_laporan_beli($id_org)
    {
        $data = Organisasi::where('id_organisasi', 'like', substr($id_org, 0, 3).'%')->where('tipe_organisasi', '3')->get();
        $data_org = Organisasi::select('id', 'id_organisasi', 'nama_organisasi')->where('id_organisasi', $id_org)->first();
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'data_org' => $data_org,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => false, 'transaksi' => true]);
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
            'meter'=>null,
            'id_org'=>$id_organisasi,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function lihat_trafo_gi($id_organisasi, $id_trafo_gi){
        $rayon = Organisasi::where('id_organisasi', $id_organisasi)->first();
        $trafo_gi = TrafoGI::where('id', $id_trafo_gi)->first();
        $transfer = Transfer::where('id_trafo_gi',$id_trafo_gi)->pluck('id_penyulang');
        $data = Penyulang::select('id','nama_penyulang', 'alamat_penyulang','data_master')
//            ->whereNotIn('id',$transfer)
            ->where('id_trafo_gi',$id_trafo_gi)
            ->get();
        $decoded = json_decode($trafo_gi->data_master, true);
//        dd($decoded);
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'decoded' =>$decoded,
            'gi'=>null,'trafo_gi'=>$trafo_gi,'penyulang'=>null,'gardu'=>null,
            'id_gi'=>null,'id_trafo_gi'=>$id_trafo_gi,'id_penyulang'=>null,'id_gardu'=>null,
            'rayon'=>$rayon,
            'meter'=>$rayon->id,
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
            'meter'=>null,
            'id_org'=>$rayon->id,
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function lihat_gardu($id_organisasi, $id_gardu){

        $rayon = Organisasi::where('id', $id_organisasi)->first();
        $gardu = Gardu::where('id', $id_gardu)->first();
        $data = Gardu::where('id', $id_gardu)->get();
        $idP = Penyulang::select('id', 'nama_penyulang')->where('id', $gardu->id_penyulang)->first();
        $decoded = json_decode($gardu->data_master, true);
        if($gardu->tipe_gardu!=1) $meter = null;
        else $meter =1;
        return view('admin.nonmaster.dashboard_user.datamaster_',[
            'data' =>$data,
            'idP' =>$idP,
            'decoded' =>$decoded,
            'gi'=>null,'trafo_gi'=>null,'gardu'=>$gardu,'penyulang'=>null,
            'id_gi'=>null,'id_trafo_gi'=>null,'id_gardu'=>$id_gardu,'id_penyulang'=>null,
            'rayon'=>$rayon,
            'meter'=>$meter,
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

        if ($edit == "gi")
            $table = GI::where('id', $id)->update(['nama_gi' => $nama, 'alamat_gi' => $alamat]);
        elseif ($edit == "t_gi")
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

    public function hapus_datamaster(Request $request)
    {
        $id_organisasi = $request->id_org;
        $tipe = $request->tipe;
        $id = $request->id;

        if ($tipe == "gi")
            $table = GI::where('id', $id)->delete();
        elseif ($tipe == "t_gi")
            $table = TrafoGI::where('id', $id)->delete();
        elseif ($tipe == "penyulang")
            $table = Penyulang::where('id', $id)->delete();
        elseif ($tipe == "gd")
            $table = Gardu::where('id', $id)->delete();
        elseif ($tipe == "pct")
            $table = Gardu::where('id', $id)->delete();
        elseif ($tipe == "p_tm")
            $table = Gardu::where('id', $id)->delete();

        return $table;
    }

    public function dashboard(){
        return view('admin.nonmaster.dashboard_user.dashboard');
    }
}