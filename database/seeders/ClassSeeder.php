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
                    'class' => '1',
                    'name' => 'Satu',
                    'roman' => 'I'
                ],
                [
                    'class' => '2',
                    'name' => 'Dua',
                    'roman' => 'II'
                ],
                [
                    'class' => '3',
                    'name' => 'Tiga',
                    'roman' => 'III'
                ],
                [
                    'class' => '4',
                    'name' => 'Empat',
                    'roman' => 'IV'
                ],
                [
                    'class' => '5',
                    'name' => 'Lima',
                    'roman' => 'V'
                ],
                [
                    'class' => '6',
                    'name' => 'Enam',
                    'roman' => 'VI'
                ],
            ]
        );
    }
}
