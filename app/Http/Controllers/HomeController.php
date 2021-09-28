<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

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
            $posts = Post::withCount('comments')
                ->whereHas('author', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->orWhere('title', 'like', '%' . $search . '%')
                ->orWhere('content', 'like', '%' . $search . '%')
                ->inRandomOrder()
                ->paginate(10);
        } else {
            $posts = Post::withCount('comments')->inRandomOrder()->paginate(10);
        }

        return view('home', compact('posts'));
    }

    public function search(Request $request)
    {
        dd($request->query('search'));
    }
}
