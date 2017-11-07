<?php

namespace App\Http\Controllers;
use App\Organisasi;
use Auth;
use Illuminate\Http\Request;
use App\Gardu;
use App\GI;
use App\TrafoGI;
use App\Transfer;
 
class RayonController extends Controller
{
    protected $id_role;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_role = Auth::user()->tipe_organisasi;
            if(!$this->id_role==3)
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

    public function list_master_rayon() {
        //dd(Auth::user()->id_organisasi);
        $data = Organisasi::where('id_organisasi', 'like', Auth::user()->id_organisasi.'%')->where('tipe_organisasi', '3')->get();
        $data_org = Organisasi::select('id', 'id_organisasi', 'nama_organisasi')->where('id_organisasi', Auth::user()->id_organisasi);
        return view('admin.nonmaster.dashboard_user.list_datamaster',[
            'data' => $data,
            'data_org' => $data_org,
            'list_distribusi' => $this->list_distribusi(),
            'laporan' => true, 'transaksi' => false]);
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
}
