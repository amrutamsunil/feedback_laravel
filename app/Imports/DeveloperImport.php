<?php

namespace App\Imports;

use App\Developer;
use Maatwebsite\Excel\Concerns\ToModel;

class DeveloperImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Developer([
            'id'=>$row[0],
            'username'=>$row[1],
            'password' => Hash::make($row[2])

        ]);
    }
}
