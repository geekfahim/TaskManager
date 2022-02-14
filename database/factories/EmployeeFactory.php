<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'office_id' => $this->faker->randomDigitNotNull(5),
            'designation'=>$this->faker->jobTitle(),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->numerify('17########'),
            'status' => $this->faker->numberBetween(1,3),
        ];
    }
}
