<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Reply;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'This is post from reply seeder',
            'slug' => Str::slug('This is post from reply seeder' . ' ' . Str::random(5)),
            'content' => 'Proin consectetur ornare nibh, at porta tellus volutpat quis. Maecenas luctus, urna vel cursus lobortis, quam tortor sollicitudin sem, ut congue nisl lorem at tortor. Donec urna mauris,suscipit mattis eu metus. Curabitur molestie eu justo egestas vulputate. Nunc finibus eleifend luctus. Sed faucibus nunc nibh, non euismod erat ullamcorper ut.'
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => $user2->id,
            'body' => 'Proin a ante dui. Phasellus a augue lectus. Vivamus fermentum est et luctus luctus. Mauris metus felis, elementum id erat nec, sempe`zr dapibus ligula'
        ]);

        Reply::create([
            'comment_id' => $comment->id,
            'user_id' => $user->id,
            'body' => 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic perspiciatis voluptas ex quidem.'
        ]);
    }
}
