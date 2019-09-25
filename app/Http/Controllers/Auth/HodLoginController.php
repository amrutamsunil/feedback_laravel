<?php
namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class HodLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hod')->except(['logout','showLoginForm','login']);
    }
    //protected $redirectTo="/";
    public function showLoginForm(){
        return view('admin.index');
    }

    public function login(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required'
        ]);
        if(Auth::guard('hod')->attempt(['name'=>$request->username,'password'=>$request->password],$request->remember)){
            Session::flash('info','Welcome HOD ');
            return redirect()->intended('hod/dashboard');
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
