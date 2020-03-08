<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    //public $class_id;
    public function __construct()
    {
        //$this->class_id=$class_id;
    }

    public function model(array $row)
    {

        return new User([
                    'id'=>$row[0],
                    'class_id'=>$row[1],
                   'student_reg'=> $row[2],
                    'name'=> $row[3],
                   'password'=> Hash::make($row[4])
        ]);
    }
}
