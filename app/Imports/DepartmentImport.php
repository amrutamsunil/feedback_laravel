<?php

namespace App\Imports;

use App\Department;
use Maatwebsite\Excel\Concerns\ToModel;

class DepartmentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Department([
            'id'=>$row[0],
            'name'=>$row[1],
            'short'=>$row[2]
        ]);
    }
}
