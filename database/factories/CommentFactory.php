<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
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
        $user = User::factory()->create();

        $post = Post::get()->count();
        if ($post < 1) {
            $newPost = Post::factory()->count(10)->create();
            $post = $newPost->id;
        }

        return [
            'user_id' => $user->id,
            'post_id' => rand(1, $post),
            'body' => $this->faker->paragraph(rand(1, 3))
        ];
    }
}
