<?php

namespace App\Http\Controllers;

use App\Gardu;
use App\Organisasi;
use App\Penyulang;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function editProfil(Request $request) {
        $id_org = $request->id_user;
        $alamat = $request->alamat;
        $org = Organisasi::where('id', $id_org)->update(['alamat' => $alamat]);
        return back()->withInput();
    }

    public function ubahPassword(Request $request) {
        $id_org = $request->id_user;
        $old = $request->password_old;
        $new = $request->password_new;

        if (Hash::check($old, Auth::user()->password)) {
            $pass = Hash::make($new);
            $org = Organisasi::where('id', $id_org)->update(['password'=> $pass]);
            $status = ["success" ,"Password Berhasil Diubah"];
        }
        else {
            $status = ["warning", "Password Salah"];
        }
        return view('admin.nonmaster.dashboard_user.profile_edit', ['status' => $status]);
    }
}
