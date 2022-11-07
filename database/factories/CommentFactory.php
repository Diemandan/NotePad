<?php

namespace Database\Factories;
use App\Models\Comment;
use Doctrine\DBAL\Schema\Sequence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Note>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'=>fake()->randomElement([1,2,3]),
            'note_id'=>fake()->randomElement([1,2,3]) ,
            'text'=>fake()->sentence(5),
        ];
    }
}
