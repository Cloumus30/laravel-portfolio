<?php

namespace Database\Factories;

use App\Models\Porto;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Porto>
 */
class PortoFactory extends Factory
{
    protected $model = Porto::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'short_desc' => fake()->text(50),
            'description' => fake()->text(500),
            'photo' => fake()->filePath(),
            'link' => fake()->text(50),
            'user_id' => User::first()->id ?? 1,
        ];
    }
}
