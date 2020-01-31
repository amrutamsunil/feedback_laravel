<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrincipalLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:principal')->except(['logout','showLoginForm','login']);
    }
    //protected $redirectTo="/";
    public function showLoginForm(){
        return view('principal.index');
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
            if(Auth::guard('principal')->attempt(['username'=>$request->username,'password'=>$request->password],$request->remember)){
            Session::flash('info','Welcome Admin ');
            return redirect()->intended('principal/dashboard');
        }else{
            Session::flash('error','Invalid Credentials');
        }

        return redirect()->back();
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
