<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absent extends Model
{
    use HasFactory;


    public static function getAbsents(array $select = null)
    {
        if ($select != null) {
            return DB::table('absents')->select()
                ->join('students', 'absents.student_id', 'students.id')->select($select);
        }
        return DB::table('absents')
            ->join('students', 'absents.student_id', 'students.id');
    }
}
