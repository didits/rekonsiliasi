<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use App\Organisasi;
use Excel;
use Hash;

class AdminController extends Controller
{
    protected $id_role;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->id_role = Auth::user()->tipe_organisasi;
            if(!$this->id_role==0)
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
        $data = Organisasi::all();
         return view('admin.nonmaster.admin.management_rayon',[
            'data'=>$data]);
    }

    public function managementRayon()
    {
         $data = Organisasi::all();
         return view('admin.nonmaster.admin.management_rayon',[
            'data'=>$data]);
    }

    public function importOrganisasi(Request $request){

        ini_set('max_execution_time',5000);
        if(count($request->file()) > 0)
            $storage = $request->file('excel');
        else
        {
            return redirect()->back()->with('status', [
                'enabled'       => true,
                'type'          => 'danger',
                'content'       => 'Gagal import Organisasi!'
            ]);
        }

        $reader = Excel::load($storage);
        if($reader->format=="Excel5"){
            $workbookTitle = $reader->get();
            foreach($workbookTitle as $list)
            {
                $organisasi = Organisasi::where('id_organisasi',$list->id_organisasi)->first();
                    if(!$organisasi){
                        $organisasi = New Organisasi();
                        $organisasi->id_organisasi = $list->id_organisasi;
                    }
                
                $organisasi->nama_organisasi = $list->nama_organisasi;
                $organisasi->tipe_organisasi = $list->tipe_organisasi;
                $organisasi->password = Hash::make($list->password);
                $organisasi->alamat = $list->alamat;
                $organisasi->save();
            }
            return redirect()->back()->with('status', [
                'enabled'       => true,
                'type'          => 'success',
                'content'       => 'Berhasil import Barang!'
            ]);
        }else{
            return redirect()->back()->with('status', [
                'enabled'       => true,
                'type'          => 'danger',
                'content'       => 'Gagal import Organisasi! Format Excel harus berextensi (xls)'
            ]);

        }

    }
}
