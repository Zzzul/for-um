<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use App\Notifications\ReplyCommentNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'reply' => 'required|string'
        ]);

        $comment = Comment::with('post')->findOrFail($request->comment_id);

        // dd($comment->user->id);

        $attr = [];
        $attr['user_id'] = auth()->id();
        $attr['comment_id'] = $comment->id;
        $attr['body'] = $request->reply;

        $reply = Reply::create($attr);

        if ($comment->user->id !== auth()->id()) {
            $comment->user->notify(new ReplyCommentNotification($reply, $comment));
        }

        return redirect()->back()->with('success', 'Reply sended.');
    }
}
