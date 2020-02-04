<?php

namespace App\Imports;

use App\Admin;
use Maatwebsite\Excel\Concerns\ToModel;

class AdminImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Admin([
            'id'=>$row[0],
            'name'     => $row[1],
            'password' => Hash::make($row[2]),
            'dept_id'=>$row[3]
        ]);
    }
}
