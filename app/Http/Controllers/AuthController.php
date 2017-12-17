<?php

namespace App\Http\Controllers;
use App\Organisasi;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $user = Organisasi::where("id",$request->id)->first();
        if($user){
            $curPassword = $request->old_pass;
            $newPassword = $request->new_pass;

            if (Hash::check($curPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
                $user->save();
                return back();
            }
            else return response()->json(["result"=>false]);
        }
        else return response()->json("user not found");
    }
}
