<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class FacultyLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:faculty')->except(['logout','showLoginForm','login']);
    }
    //protected $redirectTo="/";
    public function showLoginForm(){
        return view('faculty.index');
    }
    public function username(){
        return 'employee_number';
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        if(Auth::guard('faculty')->attempt(['employee_number'=>$request->username,'password'=>$request->password],$request->remember)){
            Session::flash('info','Welcome HOD ');
            return redirect()->intended('faculty/dashboard');
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
