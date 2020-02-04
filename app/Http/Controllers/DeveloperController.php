<?php
namespace App\Http\Controllers;
use App\Admin;
use App\Classes;
use App\Department;
use App\Developer;
use App\Faculty;
use App\Feedback;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class DeveloperController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:developer');

    }
    public function hashing(){
       /* $students=Faculty::all();
        foreach ($students as &$p){
            $p->password=bcrypt($p->password);
            $p->save();
        }*/

        return redirect()->back();

    }
    public function show_add_subject(){

        return view('developer.addSubject');
    }
    public function import_students(Request $request){
        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx',
            'class_id'=>'required'
        ]);

        //$data=Excel::load($path)->get();

        /*if(Excel::import(new UsersImport($request->class_id), $request->file('file'))){
            Session::flash('success','Data Imported Successfully ');
        }else{
            Session::flash('error','Something went wrong !!');
        }*/
        return redirect()->back();

    }

    public function add_subject(Request $request){
        $this->validate($request,[
            'subject_name'=>'required',
        'short_name'=>'required',
        'subject_type'=>'required']
        );
        $subject=new Subject;
        $subject->name=$request->subject_name;
        $subject->type=$request->subject_type;
        $subject->short=$request->short_name;
        if($subject->save()){
            Session::flash('success','Successfully Added New Subject');
        }else{
            Session::flash('error','Unable to add the record ! Try again ');
        }

        return redirect()->action('DeveloperController@show_add_subject');
    }
    public function show_add_student(){
        $class_obj=new Classes();
        $class_list=$class_obj->isActiveLists(1);
        $departments=Department::all();
        return view('developer.AddStudent')->with('classes',$class_list)
            ->with('departments',$departments);
    }
    public function dashboard(){
        return view('developer.dashboard');
    }
    public function ajax_classes_dept(Request $request){
        $this->validate($request,[
            'dept'=>'required'
        ]);
        $obj=array();
        $class_obj= new Classes();
        $classes=$class_obj->isActiveLists($request->dept);
        foreach ($classes as $class){
            $obj[$class->id]=$class->name;
        }
        return response()->json($obj);
    }
}
