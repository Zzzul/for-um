<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Notifications\PostCommentNotification;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);

        $attr = $request->validated();
        $attr['user_id'] = auth()->id();
        $attr['post_id'] = $post->id;

        $comment = Comment::create($attr);

        if ($comment->post->author->id != auth()->id()) {
            $comment->post->author->notify(new PostCommentNotification($comment->post, $comment));
        }

        return redirect()->back()->with('success', 'Comment sended.');
    }
}
