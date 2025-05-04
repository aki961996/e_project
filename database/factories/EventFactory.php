<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\User;
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
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'start_date' => now()->addDays(10),
            'end_date' => now()->addDays(11),
            'start_time' => $this->faker->time(),
            'image' => 'events/default.jpg',
            'address' => $this->faker->address,
            'num_tickets' => $this->faker->numberBetween(50, 200),
            'user_id' => User::factory(),
            'country_id' => Country::factory(),
            'city_id' => City::factory(),
        ];
    }
}
