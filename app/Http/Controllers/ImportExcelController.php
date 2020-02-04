<?php

namespace App\Http\Controllers;

use App\Imports\ClassesImport;
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

        Excel::import(new ClassesImport, $request->file('file'));



        return redirect()->back()->with('success', 'All good!');
    }
}
