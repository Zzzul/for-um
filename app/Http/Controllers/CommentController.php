<?php

namespace App\Http\Controllers;

use App\Events\PostChanged;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\{Post, Comment};
use App\Notifications\PostCommentNotification;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);

        $attr = $request->validated();
        $attr['user_id'] = auth()->id();

        $comment = Comment::create($attr);
        $comment->load('user:id,name');

        /** only send notification when user commented another user comments.*/
        if ($comment->post->author->id != auth()->id()) {
            $comment->post->author->notify(new PostCommentNotification($post, $comment));
        }

        event(new PostChanged($post));

        return redirect()->back()->with('success', 'Comment sended.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        $this->authorize('view', $comment);

        return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->load('post');

        $comment->update($request->validated());

        event(new PostChanged($comment->post));

        return redirect()->route('post.show', $comment->post->slug)->with('success', 'Comment updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->load('post');

        event(new PostChanged($comment->post));

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
