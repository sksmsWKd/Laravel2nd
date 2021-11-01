<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'comment' => $this->faker->sentence(),
            // 'user_id' => 1,
            // 'post_id' => 37,
            // 'email_verified_at' => now(),
            // 'remember_token' => Str::random(10),
        ];
    }
}