<?php

namespace App\Imports;

use App\Feedback;
use Maatwebsite\Excel\Concerns\ToModel;

class FeedbackImport implements ToModel
{

    public function model(array $row)
    {
        return new Feedback([
            'id'=>$row[0],
            'student_id'=>$row[1],
            'sa_id'=>$row[2],
            'q1'=>$row[3],
            'q2'=>$row[4],
            'q3'=>$row[5],
            'q4'=>$row[6],
            'q5'=>$row[7],
            'q6'=>$row[8],
            'q7'=>$row[9],
            'q8'=>$row[10],
            'q9'=>$row[11],
            'q10'=>$row[12],
            'sum'=>$row[13],
            'phase'=>$row[14]
        ]);
    }
}
