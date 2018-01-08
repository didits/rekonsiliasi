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
        return $this->managementRayon(1);
    }

    public function managementRayon($status)
    {
         $data = Organisasi::all();
         $dropdown_data = new AjaxController();
         return view('admin.nonmaster.admin.management_rayon',[
             'dropdown_area' => $dropdown_data->populateArea(),
             'data'     => $data,
             'status'   => $status]);
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

    public function add_org(Request $request){
        $user = $request->selArea;
        if($user==null){
            $user = Organisasi::where('tipe_organisasi', '2')->orderBy('id_organisasi','desc')->first();
            $id_org = intval($user->id_organisasi)+100;
        }
        else{
            $user = Organisasi::where('id_organisasi', 'like', substr($request->selArea, 0, 3).'%')->where('tipe_organisasi', '3')->orderBy('id_organisasi','desc')->first();
            if($user==null){
                $user = Organisasi::where('tipe_organisasi', '2')->orderBy('id_organisasi','desc')->first();
            }
            $id_org = intval($user->id_organisasi)+1;
        }
        $nama = $request->namaOrg;
        $tipe = $request->tipeOrg;
        $alamat = $request->alamatOrg;
        $pass = Hash::make($request->pass);
        $org = Organisasi::where('id_organisasi',$id_org)->first();
        if(!$org){
            $organisasi = New Organisasi();
            $organisasi->id_organisasi = $id_org;
            $organisasi->nama_organisasi = $nama;
            $organisasi->tipe_organisasi = $tipe;
            $organisasi->password = $pass;
            $organisasi->alamat = $alamat;
            $organisasi->save();
            $status = ["success" ,"Data Organisasi Berhasil Ditambah"];
        }

        else{
            $status = ["danger" ,"Data Organisasi Gagal Ditambah!"];

        }
        $data = Organisasi::all();
        $dropdown_data = new AjaxController();

        return view('admin.nonmaster.admin.management_rayon',[
            'dropdown_area' => $dropdown_data->populateArea(),
            'data'=> $data,
            'status' => $status]);

    }

    public function edit_org(Request $request){
        $org = Organisasi::where('id',$request->id_)->first();
        $dropdown_data = new AjaxController();
        $data = Organisasi::all();
        if($org){
            $org->nama_organisasi = $request->namaOrg;
            $org->alamat = $request->alamatOrg;
            $org->save();
            $status = ["success", "Berhasil diubah"];
          }
        else {
            $status = ["danger", "Gagal diubah"];
        }
        return view('admin.nonmaster.admin.management_rayon',[
            'dropdown_area' => $dropdown_data->populateArea(),
            'data'=>$data,
            'status' => $status]);

    }

    public function delete_org(Request $request){
        $id = $request->id_;
        $org = Organisasi::where('id',$id)->delete();
        $dropdown_data = new AjaxController();
        $data = Organisasi::all();
        if($org){
            $status = ["success", "Data berhasil dihapus"];
        }
        else{
            $status = ["danger", "Data gagal dihapus"];
        }
        return view('admin.nonmaster.admin.management_rayon',[
            'dropdown_area' => $dropdown_data->populateArea(),
            'data'=>$data,
            'status' => $status]);


        return $org;
    }

    public function change_pass(Request $request){
        $user = Organisasi::where("id",$request->id)->first();
        $data = Organisasi::all();
        $dropdown_data = new AjaxController();

        if($user){
            $newPassword = $request->new_pass;
            $user->password = Hash::make($newPassword);
            $user->save();
            $status = ["success" ,"Password Berhasil Diubah"];
        }
        else {
            $status = ["danger", "Password gagal diubah"];
        }
        return view('admin.nonmaster.admin.management_rayon',[
            'dropdown_area' => $dropdown_data->populateArea(),
            'data'=>$data,
            'status' => $status]);
    }
}
