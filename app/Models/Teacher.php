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

    protected $with = ['status', 'classes', 'subjects'];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function classes()
    {
        return $this->belongsToMany(ClassModel::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
