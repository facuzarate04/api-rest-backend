<?php

namespace Database\Factories\Turn;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Turn\Turn>
 */
class TurnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $date = $this->faker->dateTime();
        $duration = $this->faker->randomFloat(2,0.30,6);

        $options = [
            '1' => 'RESERVED',
            '2' => 'PENDING',
        ];
        $status = $this->faker->randomElement($options);

        return [
            'client_id' => User::factory(),
            'date' => $date,
            'duration' => $duration,
            'status' => $status
        ];
    }
}
