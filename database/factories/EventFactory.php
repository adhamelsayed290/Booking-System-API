<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'location' => $this->faker->address(),
            'date' => $this->faker->date(),
            'available_seats' => $this->faker->randomNumber(),
            'category_id' => $this->faker->numberBetween(1, 20)
        ];
    }
}
