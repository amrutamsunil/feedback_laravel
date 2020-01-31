<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DeveloperLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:developer')->except(['logout','showLoginForm','login']);
    }
    public function showLoginForm(){
        return view('developer.index');
    }
    public function username(){
        return 'username';
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        if(Auth::guard('developer')->attempt(['username'=>$request->username,'password'=>$request->password],$request->remember)){
            Session::flash('info','Welcome Developer ');
            return redirect()->intended('developer/dashboard');
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
