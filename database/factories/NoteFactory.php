<?php

namespace Database\Factories;

use App\Models\Note;
use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->randomElement([1, 2, 3]),
            'name' => fake()->unique()->text(5),
            'description' => fake()->sentence(5),
            'priority' => fake()->randomElement(['low', 'high', 'medium']),
            'remind_at' => fake()->date('Y-m-d'),
            'created_at' => fake()->unique()->date('Y-m-d h:m:s'),
        ];
    }
}
