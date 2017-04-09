<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

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
}
