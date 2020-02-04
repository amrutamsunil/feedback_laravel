<?php

namespace App\Imports;

use App\Classes;
use Maatwebsite\Excel\Concerns\ToModel;

class ClassesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Classes([
            'id'     => $row[0],
            'department_id'=>$row[1],
            'name'=>$row[2],
            'sem'=>$row[3],
            'sec'=>$row[4],
            'batch'=>$row[5],
            'isActive'=>$row[6]
        ]);
    }
}
