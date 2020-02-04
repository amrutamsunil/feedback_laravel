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
                    'class_id'=>$row[0],
                   'student_reg'    => $row[1],
            'name'     => $row[2],
                   'password' => Hash::make($row[3])


        ]);
    }
}
