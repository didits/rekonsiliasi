<?php

namespace App\Http\Controllers;

use App\GI;
use App\PenyimpananGI;
use App\TrafoGI;
use DateTime;
use Illuminate\Http\Request;
use Auth;
use App\Organisasi;

class DistribusiController extends Controller
{
    protected $id_role;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_role = Auth::user()->tipe_organisasi;
            if(!$this->id_role==1)
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
         return view('admin.nonmaster.dashboard_user.index');
    }

    public function list_area(){
        $data = Organisasi::where('tipe_organisasi', '2')->get();
        return $data;
    }

    public function list_area_master(){
        return view('admin.nonmaster.dashboard_user.list_area',[
            'data' => $this->list_area(),
            'master' => true
        ]);
    }

    public function list_area_transaksi(){
        return view('admin.nonmaster.dashboard_user.list_area',[
            'data' => $this->list_area(),
            'master' => false
        ]);
    }

    public function list_rayon($id_organisasi){
        $data = Organisasi::where('id_organisasi', 'like', substr($id_organisasi, 0, 3).'%')->where('tipe_organisasi', '3')->get();
//        dd($data);
        $org = Organisasi::where('id_organisasi', $id_organisasi)->get();
        return view('admin.nonmaster.dashboard_user.list_rayon',[
            'data' => $data,
            'org' => $org[0]
        ]);
//            'id' => $data->id_organisasi]);
    }

    public function reload($id_organisasi){
        $Laporan = new Laporan;
        $Laporan->view_beli_tsa($id_organisasi, "area", "penyulang");
        return back();
    }

    public function list_distribusi($id_area){

        $home = new HomeController;
        $date_now = $home->MonthShifter(-1)->format(('Ym'));
        $gi = array();
        $null = array(
            0=>"(tidak ada data transaksi)"
        );
        $i=1;
        foreach ($id_area as $area) {
            $subarea = substr($area, 0, 3) . "%%";
            $rayon = Organisasi::select('id', 'id_organisasi')
                ->where([
                    ['id_organisasi', 'like', $subarea],
                    ['tipe_organisasi', '!=', 2]])
                ->pluck('id');
            foreach ($rayon as $idr) {
                $data_gi= GI::select('gi.id', 'organisasi.nama_organisasi', 'gi.nama_gi', 'gi.alamat_gi', 'gi.data_master')
                    ->where('gi.id_organisasi', $idr)
                    ->join('organisasi', 'organisasi.id', '=', 'gi.id_organisasi')
                    ->first();
                $pgi = PenyimpananGI::where('id_gi',$data_gi['id'])->where('periode',$date_now)->pluck('updated_at')->toArray();
                if($pgi) {
                    array_push($gi,$pgi);
                    break;
                }
            }
            if(count($gi)<$i){
                array_push($gi,$null);
            }
            $i+=1;
        }
        return $gi;
    }

    public function dashboard2(){
        $home = new HomeController;
        $date = $home->MonthShifter(-1)->format(('F Y'));
        $date_now = $home->MonthShifter(-1)->format(('Ym'));
        $id_area = Organisasi::where('tipe_organisasi',2)->pluck("id_organisasi");
        $Sumdev =0;
        $Sumsusut =0;
        $GI = PenyimpananGI::where("periode", $date_now)->get();
        foreach ($GI as $data){
            if(json_decode($data->data,true)['deviasi']==0){
                $Sumdev +=1;
            }
            if(json_decode($data->data,true)['susut_']==0){
                $Sumsusut +=1;
            }

        }
        if(count($GI)<1){
            $persen_susut = 0;
            $persen_dev = 0;
        }else{
            $persen_susut = $Sumsusut/count($GI);
            $persen_dev = $Sumdev/count($GI);
        }
        return view('admin.nonmaster.dashboard_user.dashboard', [
            'data' => $this->list_area(),
            'date' => $date,
            'deviasi' => $Sumdev,
            'persen_susut' => $persen_susut,
            'persen_dev' => $persen_dev,
            'jumlah_gi' => count($GI),
            'susut' => $Sumsusut,
            'time' => $this->list_distribusi($id_area),
             'distribusi' => true
        ]);
    }

    public function dashboard(){
        $Laporan = new Laporan;
//        $data = $Laporan->deviasi_area(Auth::user()->id_organisasi, 'area', 0);
//        dd(Auth::user()->id_organisasi);
//        $sumDev = count($data['jumlah']);
//        $devNorm = $devAbnorm = 0;
//        for($i=0; $i<$sumDev; $i++){
//            if($data['jumlah'][$i]['L'] > 2) $devAbnorm++;
//            elseif($data['jumlah'][$i]['L'] < 2) $devNorm++;
//        }
//        $deviasi = array();
//        $deviasi[] = [($sumDev === 0 ? 0:intval(($devNorm/$sumDev)*100)), $devNorm];
//        $deviasi[] = [($sumDev === 0 ? 0:intval(($devAbnorm/$sumDev)*100)), $devAbnorm];
//        $deviasi[] = $sumDev;

//        $data = $Laporan->tsa_gi_peny(Auth::user()->id_organisasi, 'area', 'penyulang');
//        $trafo      = $data['trafo'];
//        $nama_gi    = $data['nama_gi'];
//        $data_jumlah= $data['jumlah_trafo'];
        $loss_gi    = array();
//        for($gi=0;$gi<count($trafo);$gi++){
//            $totKwh     = 0;
//            $totJual    = 0;
//            for($tr=0;$tr<count($trafo[$gi]);$tr++){
//                $totKwh     += $data_jumlah[$gi][$tr]['total_kwh'];
//                $totJual    += $data_jumlah[$gi][$tr]['jual'];
//            }
//            if($totKwh === 0) $losses = 0;
//            else $losses = ($totKwh-$totJual)/$totKwh*100;
//
//            $loss_gi[] = [  "id"        => $nama_gi[$gi]['id'],
//                "nama_gi"   => $nama_gi[$gi]['nama_gi'],
//                "losses"    => $losses];
//        }

        $dataa = $Laporan->data_dist();
        $data = $dataa['data_RD'];
        for($i=0;$i<count($data);$i++){
            for($j=0;$j<count($data[$i]['gi']);$j++){
                $data[$i]['gi'][$j]['gi'];
                $data[$i]['gi'][$j]['total_jumlah']['losses'];
                $loss_gi[] = [  "nama_gi"   => $data[$i]['gi'][$j]['gi'],
                                "losses"    => $data[$i]['gi'][$j]['total_jumlah']['losses'],
                                "deviasi"   => $data[$i]['dev'][$j]['L']];
            }
        }

        $sumDev = count($loss_gi);
        $devNorm = $devAbnorm = 0;
        for($i=0; $i<$sumDev; $i++){
            if($loss_gi[$i]['deviasi'] > 2) $devAbnorm++;
            elseif($loss_gi[$i]['deviasi'] < 2) $devNorm++;
        }
        $deviasi = array();
        $deviasi[] = [($sumDev === 0 ? 0:intval(($devNorm/$sumDev)*100)), $devNorm];
        $deviasi[] = [($sumDev === 0 ? 0:intval(($devAbnorm/$sumDev)*100)), $devAbnorm];
        $deviasi[] = $sumDev;

        $sumSut = count($loss_gi);
        $susutNorm = $susutAbnorm = 0;
        for($i=0; $i<$sumSut; $i++){
            if($loss_gi[$i]['losses'] > 6) $susutAbnorm++;
            elseif($loss_gi[$i]['losses'] < 6) $susutNorm++;
        }
        $susut = array();
        $susut[] = [($sumSut === 0 ? 0:intval(($susutNorm/$sumSut)*100)), $susutNorm];
        $susut[] = [($sumSut === 0 ? 0:intval(($susutAbnorm/$sumSut)*100)), $susutAbnorm];
        $susut[] = $sumSut;

        $home = new HomeController;
        $date = $home->MonthShifter(-1)->format(('F Y'));
        return view('admin.nonmaster.dashboard_user.dashboard', [
            'date'   => $date,
            'deviasi'   => $deviasi,
            'susut'     => $susut
        ]);
    }
}
