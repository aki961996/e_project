<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\RequisitionItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequisitionItem>
 */
class RequisitionItemFactory extends Factory
{

    protected $model = RequisitionItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item' => $this->faker->word(),
            'is_gift' => $this->faker->boolean(),
            'optional' => $this->faker->boolean(),
            'claimed' => $this->faker->boolean(),
            'claimed_by' => null,
            'visibility' => $this->faker->randomElement(['public', 'private']),

        ];
    }
}
