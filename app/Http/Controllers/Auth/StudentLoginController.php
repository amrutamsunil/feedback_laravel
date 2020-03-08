<?php

namespace App\Http\Controllers\Auth;

use App\Classes;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
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

        $class_obj=new Classes();
        $active_classes=$class_obj->isActive();
        //$show=User::where('student_reg','=',$request->username)->get();
        $obj=User::where('student_reg','=',$request->username)
            ->whereIn('class_id',$active_classes)->first();
        if(Auth::guard('student')->attempt(['student_reg'=>$request->username,'password'=>$request->password,'id'=>$obj->id],$request->remember)){
            Session::flash('info','Welcome Admin');
            return redirect()->intended('user/dashboard');

        }

            Session::flash('Error','Invalid Credentials');

        return redirect()->back();
    }
    public function change_password(Request $request){
        $this->validate($request,[
            'old_password'=>'required',
            'new_password'=>'required'
        ]);
        if((Hash::make($request->old_password))===(auth()->user()->getAuthPassword())){
        $user_records=User::where('student_reg','=',auth()->user()->student_reg)->get();
        foreach ($user_records as &$user_record){
            $user_record->password=Hash::make($request->new_password);
        }
        Session::flash('success',"Password changed successfully !");
        }else{
            Session::flash('error',"Can't Reset Password");
        }
        //$this->logout();

    }
    public function logout() {
        Auth::logout();
        return redirect('/');
    }
}
