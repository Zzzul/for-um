<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::first();

        $title = 'This is post from post seeder';

        Post::create([
            'user_id' => $user->id,
            'title' => $title,
            'slug' => Str::slug($title . ' ' . Str::random(5)),
            'content' => '<h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h3>

            Vivamus rhoncus condimentum sem, sit amet venenatis justo sagittis vitae. Etiam dui augue, suscipit et rhoncus sit amet, imperdiet at felis. Nunc diam justo, interdum sed mauris in, posuere ullamcorper lorem.

            <br><br>

            <ul>
                <li>Duis vestibulum lorem eget dui consequat, id efficitur orci euismod.</li>
                <li>Nulla quis finibus magna. Sed vitae lacus in massa faucibus elementum at sed nisl.</li>
                <li>Duis condimentum convallis purus, nec finibus est tristique et.</li>
            </ul>

            Praesent elementum libero in tellus suscipit tincidunt. Maecenas vel risus sed risus cursus aliquam. Pellentesque ut dui in risus lacinia ullamcorper. Suspendisse maximus in elit nec bibendum. Suspendisse sit amet tempus nulla. Pellentesque ac imperdiet ex, id fermentum nulla.'
        ]);
    }
}
