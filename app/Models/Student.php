<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['class', 'status'];


    public function scopeFilters($query, array $request)
    {
        $query->when($request['name'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });
        $query->when(
            $request['class'] ?? false,
            fn ($query, $search) =>
            $query->where('class_id', $search)
        );
        $query->when(
            $request['gender'] ?? false,
            fn ($query, $search) =>
            $query->where('gender', $search)
        );
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }


    public function getRouteKeyName()
    {
        return 'nisn';
    }
}
