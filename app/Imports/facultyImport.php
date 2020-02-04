<?php

namespace App\Imports;

use App\Faculty;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class facultyImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faculty([
            'id'=>$row[0],
            'department_id'=>$row[1],
            'employee_number'=>$row[2],
            'name'=>$row[3],
            'password' => Hash::make($row[4])

        ]);
    }
}
