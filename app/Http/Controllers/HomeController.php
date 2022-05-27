<?php

namespace App\Http\Controllers;

use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = [];
        $search = request()->query('search');

        if ($search) {
            $posts = Post::with('author:id,name,avatar')
                ->withCount('comments')
                ->whereHas('author', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
                ->inRandomOrder()
                ->paginate(10);
        } else {
            $posts = Post::with('author:id,name,avatar')
                ->withCount('comments')
                ->inRandomOrder()
                ->paginate(10);
        }

        return view('home', compact('posts'));
    }
}
