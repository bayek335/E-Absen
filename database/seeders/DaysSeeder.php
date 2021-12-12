<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert([
            ['name' => 'senin'],
            ['name' => 'selase'],
            ['name' => 'rabu'],
            ['name' => 'kamis'],
            ['name' => "jum'at"],
            ['name' => 'sabtu'],
            ['name' => 'minggu'],
        ]);
    }
}
