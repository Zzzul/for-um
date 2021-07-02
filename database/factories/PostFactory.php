<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $title = $this->faker->sentence(rand(1, 15));

        return [
            'user_id' => $user->id,
            'title' => $title,
            'slug' => Str::slug($title . ' ' . Str::random(5)),
            'content' => $this->faker->paragraph(rand(1, 12))
        ];
    }
}
