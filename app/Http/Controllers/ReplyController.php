<?php

namespace App\Http\Controllers;

use App\Events\PostChanged;
use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;
use App\Models\Comment;
use App\Notifications\ReplyCommentNotification;

class ReplyController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreReplyRequest $request)
    {
        $comment = Comment::withOnly('post')->findOrFail($request->comment_id);

        $attr = $request->validated();

        // get the reply body by comment id
        $body = 'reply-' . $request->comment_id;
        $attr['body'] = $request->$body;
        $attr['user_id'] = auth()->id();

        $reply = Reply::create($attr);
        $reply->load('user:id,name');

        if ($comment->user->id !== auth()->id()) {
            // Notify the user if reply another user comment
            $comment->user->notify(new ReplyCommentNotification($reply, $comment));
        }

        $reply->load('comment.post');

        event(new PostChanged($reply->comment->post));

        return redirect()->back()->with('success', 'Reply sended.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        $this->authorize('view', $reply);

        return view('replies.edit', compact('reply'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateReplyRequest $request, Reply $reply)
    {
        $this->authorize('update', $reply);

        $reply->load('comment.post');

        $attr = $request->validated();
        $attr['body'] = $request->reply;

        $reply->update($attr);

        event(new PostChanged($reply->comment->post));

        return redirect()->route('post.show', $reply->comment->post->slug)->with('success', 'Reply updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);

        $reply->load('comment.post');

        event(new PostChanged($reply->comment->post));

        $reply->delete();

        return redirect()->back()->with('success', 'Reply deleted.');
    }
}
