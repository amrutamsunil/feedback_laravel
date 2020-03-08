<?php

namespace App\Http\Controllers;

use App\Imports\AdminImport;
use App\Imports\ClassesImport;
use App\Imports\DepartmentImport;
use App\Imports\facultyImport;
use App\Imports\FeedbackImport;
use App\Imports\PrincipalImport;
use App\Imports\Subject_allocImport;
use App\Imports\SubjectImport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\DB;

class ImportExcelController extends Controller
{
    public function index(){
        return view('developer.import_excel');
    }
    public function import(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new UsersImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_dept(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new DepartmentImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_principal(Request $request){

        $this->validate($request,[
            'file'=>'required|mimes:xls,xlsx,csv',
        ]);
        //$data=Excel::load($path)->get();

        Excel::import(new PrincipalImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_classes(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new ClassesImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_admin(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new AdminImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_faculty(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new facultyImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_subject(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new SubjectImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_subject_alloc(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new Subject_allocImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
    public function import_feedback(Request $request){


        //$data=Excel::load($path)->get();

        Excel::import(new FeedbackImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }


}
