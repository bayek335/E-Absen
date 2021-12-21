<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Absent extends Model
{
    use HasFactory;

    protected static $join = ['students', 'absents.student_id', 'students.id'];

    public static function getAbsents(array $select = null)
    {
        if ($select != null) {
            return DB::table('absents')
                ->join(...self::$join)->select($select);
        }
        return DB::table('absents')
            ->join(...self::$join);
    }

    public static function getReports(array $request)
    {
        $select = 'sum(absents.attend) as attend_total, sum(absents.permit) as permit_total, sum(absents.alpha) as alpha_total, students.name, students.class_id, students.nisn, students.gender, students.id as student_id';
        $groupBy = ['students.id', 'students.name', 'students.class_id', 'students.nisn', 'students.gender'];

        $reports  = DB::table('absents')
            ->join(...self::$join)
            ->selectRaw($select)
            ->groupBy(...$groupBy);

        $attend = DB::table('absents')
            ->join(...self::$join)
            ->select('year', 'month', 'day', 'attend', 'permit', 'alpha', 'students.id as student_id');

        $data = [
            'reports' => $reports,
            'attend' => $attend,
        ];

        if ($request['year'] ?? false and $request['month'] ?? false) {
            $data['reports'] = $reports->where('year', $request['year'])->where('month', $request['month']);
            $data['attend'] = $attend->where('year', $request['year'])->where('month', $request['month']);
        } else if ($request['year'] ?? false) {

            $data['reports'] = $reports->where('year', $request['year']);
            $data['attend'] = $attend->where('year', $request['year']);
        } else if ($request['month'] ?? false) {
            $data['reports'] = $reports->where('month', $request['month']);
            $data['attend'] = $attend->where('month', $request['month']);
        } else {
            $data['reports'] = $reports->where('month', date('m'));
            $data['attend'] = $attend->where('month',  date('m'));
        }
        return $data;
    }

    public static function getCountAttend($year)
    {
        return DB::table('absents')
            ->join(...self::$join)
            ->selectRaw('sum(attend) as attend_total, sum(permit) as permit_total, sum(alpha) as alpha_total,month, students.id as student_id')
            ->groupBy('month', 'students.id')
            ->where('year', $year);
    }
}
