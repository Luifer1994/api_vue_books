<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'names'         => $this->faker->name,
            'last_name'     => $this->faker->name,
            'dni'           => $this->faker->unique()->randomNumber(),
            'email'         => $this->faker->unique()->safeEmail(),
            'phone'         => $this->faker->randomNumber(),
        ];
    }
}
