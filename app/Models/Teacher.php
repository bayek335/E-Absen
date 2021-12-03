<?php

namespace App\Models;

use App\Models\Status;
use App\Models\Subject;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $timestamp = true;

    protected $with = ['status', 'class', 'subjects'];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
