<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('classes')->insert(
            [
                [
                    'name' => 'Satu',
                    'roman' => 'I'
                ],
                [
                    'name' => 'Dua',
                    'roman' => 'II'
                ],
                [
                    'name' => 'Tiga',
                    'roman' => 'III'
                ],
                [
                    'name' => 'Empat',
                    'roman' => 'IV'
                ],
                [
                    'name' => 'Lima',
                    'roman' => 'V'
                ],
                [
                    'name' => 'Enam',
                    'roman' => 'VI'
                ],
            ]
        );
    }
}
