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
        $user = User::factory()->create();
        $user2 = User::factory()->create();

        $post = Post::create([
            'user_id' => $user->id,
            'title' => 'This is post from comment seeder',
            'slug' => Str::slug('This is post from comment seeder' . ' ' . Str::random(5)),
            'content' => 'Donec lobortis erat dolor, a rutrum magna tempus a. Vestibulum facilisis molestie elit, et malesuada arcu facilisis eget. Proin consectetur ornare nibh, at porta tellus volutpat quis. Maecenas luctus, urna vel cursus lobortis, quam tortor sollicitudin sem, ut congue nisl lorem at tortor. Donec urna mauris, porta vitae faucibus in, efficitur ac elit. Maecenas quis dignissim lectus, at maximus est. Duis tristique pellentesque quam. Donec mattis fringilla tellus accumsan consequat.

            Etiam sit amet nulla varius, sollicitudin nisi sit amet, mattis velit. Maecenas vitae elit eget ante sodales suscipit mattis eu metus. Curabitur molestie eu justo egestas vulputate. Nunc finibus eleifend luctus. Sed faucibus nunc nibh, non euismod erat ullamcorper ut. Proin a ante dui. Phasellus a augue lectus. Vivamus fermentum est et luctus luctus. Mauris metus felis, elementum id erat nec, semper dapibus ligula.'
        ]);

        Comment::create([
            'post_id' => $post->id,
            'user_id' => $user2->id,
            'body' => ' Donec urna mauris, porta vitae faucibus in, efficitur ac elit. Maecenas quis dignissim lectus, at maximus est. Duis tristique pellentesque quam.'
        ]);
    }
}
