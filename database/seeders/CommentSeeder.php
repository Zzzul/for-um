<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $post = Post::first();

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'body' => 'Donec urna mauris, porta vitae <b>faucibus in</b>, efficitur ac elit.
            <br>
            Maecenas quis dignissim lectus, at maximus est. Duis tristique pellentesque quam.'
        ]);
    }
}
