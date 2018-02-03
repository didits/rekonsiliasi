<?php

namespace App\Http\Controllers;

use App\Organisasi;
use DateTime;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\Array_;

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
            return redirect('area/dashboard')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==1){
            return redirect('distribusi/dashboard')->with('status', [
//            return redirect('distribusi')->with('status', [
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
            return redirect('area/dashboard')->with('status', [
            'enabled'       => true,
            'type'          => 'success',
            'content'       => 'Berhasil login!'
            ]);
        }else if(Auth::user()->tipe_organisasi==1){
            return redirect('distribusi/dashboard')->with('status', [
//            return redirect('distribusi')->with('status', [
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

    public function populateArea()
    {
        $dropdown_area = Organisasi::select('id_organisasi', 'nama_organisasi')->get();
        return $dropdown_area;
    }

    public function MonthShifter ($months){
        $aDate = new DateTime("now");
        $dateA = clone($aDate);
        $dateB = clone($aDate);
        $plusMonths = clone($dateA->modify($months . ' Month'));
        //check whether reversing the month addition gives us the original day back
        if($dateB != $dateA->modify($months*-1 . ' Month')){
            $result = $plusMonths->modify('last day of last month');
        } elseif($aDate == $dateB->modify('last day of this month')){
            $result =  $plusMonths->modify('last day of this month');
        } else {
            $result = $plusMonths;
        }
        return $result;
    }

}
