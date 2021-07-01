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
        $user = User::factory()->create();

        Post::create([
            'user_id' => $user->id,
            'title' => 'This is post from seeder',
            'slug' => Str::slug('This is post from post seeder' . ' ' . Str::random(5)),
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus rhoncus condimentum sem, sit amet venenatis justo sagittis vitae. Etiam dui augue, suscipit et rhoncus sit amet, imperdiet at felis. Nunc diam justo, interdum sed mauris in, posuere ullamcorper lorem. Duis vestibulum lorem eget dui consequat, id efficitur orci euismod. Nulla quis finibus magna. Sed vitae lacus in massa faucibus elementum at sed nisl. Duis condimentum convallis purus, nec finibus est tristique et.

            Praesent elementum libero in tellus suscipit tincidunt. Maecenas vel risus sed risus cursus aliquam. Pellentesque ut dui in risus lacinia ullamcorper. Suspendisse maximus in elit nec bibendum. Suspendisse sit amet tempus nulla. Pellentesque ac imperdiet ex, id fermentum nulla. Sed a rhoncus lorem. Phasellus pretium ultrices ullamcorper. Sed non fringilla diam, id vulputate nisl. Cras id urna finibus, lobortis nisi quis, ultricies nibh. In a elit rhoncus, faucibus metus vel, tempor eros. Suspendisse vitae auctor nibh, vel fermentum nisi. Etiam est odio, bibendum malesuada mi at, feugiat rhoncus turpis. Proin pulvinar, tellus sed tempor dictum, turpis arcu fringilla risus, a dapibus quam tellus vel sapien. Curabitur in metus ante.'
        ]);
    }
}
