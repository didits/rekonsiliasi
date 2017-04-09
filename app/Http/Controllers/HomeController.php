<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $id_role;
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
        if(Auth::user()->tipe_organisasi==3){
            return redirect('rayon')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==2){
            return redirect('area')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==1){
            return redirect('distribusi')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==0){
            return redirect('admin')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }
            return $next($request);
        });
    }

    public function index(){
        if(Auth::user()->tipe_organisasi==3){
            return redirect('rayon')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==2){
            return redirect('area')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==1){
            return redirect('distribusi')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==0){
            return redirect('admin')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }
    }

}
