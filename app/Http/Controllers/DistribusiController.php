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
        return view('admin.nonmaster.dashboard_user.dashboard');
    }
}
