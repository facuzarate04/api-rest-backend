<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserType>
 */
class UserTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $options = [
            '1' => 'OWNER',
            '2' => 'CLIENT',
            '3' => 'EMPLOYEE'
        ];
        $name = $this->faker->unique()->randomElement($options);
        return [
            'name' => $name
        ];
    }
}
