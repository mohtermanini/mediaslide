<?php

namespace Database\Factories;

use App\Enums\GendersEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FashionModel>
 */
class FashionModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'description' => $this->faker->paragraph(),
            'date_of_birth' => $this->faker->date('Y-m-d', '-18 years'),
            'height' => $this->faker->numberBetween(150, 200),
            'shoe_size' => $this->faker->randomFloat(1, 5, 15),
            'gender' => $this->faker->randomElement([GendersEnum::MALE->value, GendersEnum::FEMALE->value]),
        ];
    }
}
