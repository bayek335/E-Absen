<?php

namespace App\Imports;

use App\Models\SecondaryPassword;
use App\Models\student;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class studentsImport implements ToCollection
{

    /**
     * @param array $row
     */

    public function __construct($class)
    {
        $this->class = $class;
        $this->default_img_name = 'images/profile_images/default-profile-picture.png';
    }
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if ($row[1] || $row[2] || $row[3]) {
                $password = str_replace('/\s/g', '', strtoupper(date('i') . $row[1] . (random_int(0, 10) * 9)));

                $student = new Student();
                $secondaryPassword = new SecondaryPassword();

                $student->nisn = $row[1];
                $student->name = $row[2];
                $student->username = str_replace('/\s/g', '', strtoupper($row[1] . substr($row[2], 0, 5)));
                $student->password = password_hash($password, PASSWORD_BCRYPT);
                $student->gender = $row[3];
                $student->class_id = $this->class;
                $student->image = $this->default_img_name;
                $student->save();

                $secondaryPassword->student_id = $student->id;
                $secondaryPassword->secondary_password = $password;
                $secondaryPassword->save();
            }
        }
    }
}
