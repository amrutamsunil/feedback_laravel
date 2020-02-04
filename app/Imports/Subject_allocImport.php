<?php

namespace App\Imports;

use App\Subject_Alloc;
use Maatwebsite\Excel\Concerns\ToModel;

class Subject_allocImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Subject_Alloc([
            'id'=>$row[0],
            'class_id'=>$row[1],
            'subject_id'=>$row[2],
            'faculty_id'=>$row[3]
        ]);
    }
}
