<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert(
            [
                [
                    'name' => 'kepala sekolah',
                    'homeroom' => 0
                ],
                [
                    'name' => 'guru',
                    'homeroom' => 1
                ],
                [
                    'name' => 'guru',
                    'homeroom' => 0
                ],
                [
                    'name' => 'siswa',
                    'homeroom' => 0
                ],
            ]
        );
    }
}
