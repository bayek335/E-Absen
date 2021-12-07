<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = ['laki-laki', 'perempuan'];

        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->userName(),
            'password' => password_hash('student123', PASSWORD_DEFAULT),
            'gender' => $gender[random_int(0, 1)],
            'class_id' => random_int(1, 6),
        ];
    }
}
