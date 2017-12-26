<?php

namespace App\Http\Controllers;

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

    public function dashboard(){
        $Laporan = new Laporan;
        $data = $Laporan->deviasi_area(Auth::user()->id_organisasi, 'area', 0);
//        dd(Auth::user()->id_organisasi);
        $sumDev = count($data['jumlah']);
        $devNorm = $devAbnorm = 0;
        for($i=0; $i<$sumDev; $i++){
            if($data['jumlah'][$i]['L'] > 2) $devAbnorm++;
            elseif($data['jumlah'][$i]['L'] < 2) $devNorm++;
        }
        $deviasi = array();
        $deviasi[] = [($sumDev === 0 ? 0:intval(($devNorm/$sumDev)*100)), $devNorm];
        $deviasi[] = [($sumDev === 0 ? 0:intval(($devAbnorm/$sumDev)*100)), $devAbnorm];
        $deviasi[] = $sumDev;

        $data = $Laporan->tsa_gi_peny(Auth::user()->id_organisasi, 'area', 'penyulang');
        $trafo      = $data['trafo'];
        $nama_gi    = $data['nama_gi'];
        $data_jumlah= $data['jumlah_trafo'];
        $loss_gi    = array();
        for($gi=0;$gi<count($trafo);$gi++){
            $totKwh     = 0;
            $totJual    = 0;
            for($tr=0;$tr<count($trafo[$gi]);$tr++){
                $totKwh     += $data_jumlah[$gi][$tr]['total_kwh'];
                $totJual    += $data_jumlah[$gi][$tr]['jual'];
            }
            if($totKwh === 0) $losses = 0;
            else $losses = ($totKwh-$totJual)/$totKwh*100;

            $loss_gi[] = [  "id"        => $nama_gi[$gi]['id'],
                "nama_gi"   => $nama_gi[$gi]['nama_gi'],
                "losses"    => $losses];
        }

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

//        dd($deviasi);
        return view('admin.nonmaster.dashboard_user.dashboard', [
            'deviasi'   => $deviasi,
            'susut'     => $susut
        ]);
    }
}
