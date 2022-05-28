<?php

namespace App\Http\Controllers;

use App\Events\PostChanged;
use App\Models\Post;
use Illuminate\Support\Str;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('show');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author:id,name')
            ->withCount('comments')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->paginate();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $attr = $request->validated();
        $attr['slug'] = Str::slug($request->title . ' ' . Str::random(5));
        $attr['user_id'] = auth()->id();

        Post::create($attr);

        return redirect()->route('post.index')->with('success', 'Post published.');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $post = Cache::remember(Str::slug('post_' . $slug), now()->addDay(), function () use ($slug) {
            return Post::where('slug', $slug)
                ->with('author:id,name', 'comments', 'comments.user:id,name', 'comments.replies', 'comments.replies.user:id,name')
                ->withCount('up_votes', 'down_votes', 'comments')
                ->firstOrFail();
        });

        $hasVote = '';

        if (auth()->user()) {
            $hasVote = Cache::remember(Str::slug('vote_' . auth()->id() . '_' . $post->id), now()->addDay(), function () use ($post) {
                return Post::hasVote($post->id);
            });
        }

        return view('posts.show', compact('post', 'hasVote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $post = Cache::remember(Str::slug('post_' . $slug . '_edit'), now()->addDay(), function () use ($slug) {
            return Post::where('slug', $slug)->firstOrFail();
        });

        $this->authorize('view', $post);

        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $this->authorize('update', $post);

        $post->update($request->validated());

        event(new PostChanged($post));

        return redirect()->route('post.show', $post->slug)->with('success', 'Post updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        event(new PostChanged($post));

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Post deleted.');
    }
}
