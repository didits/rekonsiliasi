<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Organisasi;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm()
    {
        return view('auth.login', [
            'dropdown_area'=>$this->populateArea()
        ]);
    }

    public function populateArea()
    {
        $dropdown_area = Organisasi::select('id_organisasi', 'nama_organisasi', 'tipe_organisasi')->orderBy("nama_organisasi")->get();
        return $dropdown_area;
    }

    public function username()
    {
        return 'id_organisasi';
    }
}
