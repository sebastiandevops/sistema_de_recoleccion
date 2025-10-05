<?php

namespace Database\Factories;

use App\Models\Collection;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectionFactory extends Factory
{
    protected $model = Collection::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->randomElement(['organic', 'inorganic', 'hazardous']),
            'mode' => $this->faker->randomElement(['doorstep', 'dropoff']),
            'frequency' => $this->faker->numberBetween(1,7),
            'scheduled_at' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
            'kilos' => $this->faker->randomFloat(2, 1, 100),
            'status' => 'scheduled',
            'notes' => $this->faker->optional()->text(100),
        ];
    }
}
