<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReplyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reply::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();

        $comment = Comment::get()->count();
        if ($comment < 1) {
            $newComment = comment::factory()->count(10)->create();
            $comment = $newComment->id;
        }

        return [
            'user_id' => $user->id,
            'comment_id' => rand(1, $comment),
            'body' => $this->faker->paragraph(rand(1, 5))
        ];
    }
}
