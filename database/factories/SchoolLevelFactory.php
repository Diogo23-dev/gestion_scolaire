<?php

namespace Database\Factories;

use App\Models\SchoolLevel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SchoolLevel>
 */
class SchoolLevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Primaire',
                'Collège',
                'Lycée',
            ]),
        ];
    }
}
