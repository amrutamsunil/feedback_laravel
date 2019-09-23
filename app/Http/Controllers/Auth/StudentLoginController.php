<?php

namespace App\Http\Controllers\Auth;

use App\Classes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:student')->except(['logout','showLoginForm','login']);
    }
    //protected $redirectTo="/";
    public function showLoginForm(){
        return view('user.index');
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        if(Auth::guard('student')->attempt(['student_reg'=>$request->username,'password'=>$request->password,'isActive'=>1],$request->remember)){
            //Session::flash('info','Welcome Admin');
            return redirect()->intended('user/dashboard');
        }

            //Session::flash('Error','Invalid Credentials');

        return redirect()->back();
    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
