<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectTeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_teacher')->insert([
            [
                'subject_id' => 1,
                'teacher_id' => 1,
            ],
            [
                'subject_id' => 1,
                'teacher_id' => 2,
            ],
            [
                'subject_id' => 3,
                'teacher_id' => 1,
            ]
        ]);
    }
}
