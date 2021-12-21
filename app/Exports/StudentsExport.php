<?php

namespace App\Exports;

use App\Models\SecondaryPassword;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return
            Student::join('status', 'students.status_id', 'status.id')
            ->join('classes', 'students.class_id', 'classes.id')
            ->join('secondary_passwords', 'students.id', 'secondary_passwords.student_id')
            ->get(['nisn', 'students.name', 'username', 'secondary_password', 'status.name', 'classes.class']);
    }
}
