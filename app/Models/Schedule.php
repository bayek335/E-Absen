<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $with = ['classes', 'subjects', 'days'];

    public function getSchedulesIndex($class_id)
    {
        return DB::table('schedules')
            ->join('classes', 'class_id', '=', 'classes.id')
            ->join('days', 'day_id', '=', 'days.id')
            ->join('subjects', 'subject_id', '=', 'subjects.id')
            ->select(DB::raw('count(schedules.day_id) as sbj_count , days.name as day_name, schedules.day_id, schedules.class_id, classes.name as class_name, classes.roman, classes.id as class_id'))
            ->where('schedules.class_id', $class_id)
            ->groupBy('schedules.day_id', 'schedules.class_id', 'days.name', 'classes.name', 'classes.id', 'classes.roman');
    }

    public function getSchedules()
    {
        return DB::table('schedules')
            ->join('classes', 'class_id', '=', 'classes.id')
            ->join('days', 'day_id', '=', 'days.id')
            ->join('subjects', 'subject_id', '=', 'subjects.id')
            ->select('schedules.*', 'classes.*', 'days.*', 'subjects.*', 'classes.name as class_name', 'days.name as day_name', 'subjects.name as sbj_name');
    }
}
