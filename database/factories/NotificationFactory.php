<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->unique()->text(5),
            'description' => fake()->sentence(5),
            'updated_at' => fake()->date('Y-m-d'),
            'created_at' => fake()->unique()->date('Y-m-d h:m:s'),
        ];
    }
}
