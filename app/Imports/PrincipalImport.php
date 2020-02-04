<?php

namespace App\Imports;

use App\Principal;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PrincipalImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Principal([
            'id'=>$row[0],
            'username'=>$row[1],
            'password' => Hash::make($row[2])
        ]);
    }
}
