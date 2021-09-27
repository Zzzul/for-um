<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Post;
use App\Models\Comment;
use App\Notifications\PostCommentNotification;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::where('user_id', auth()->id())->paginate(10);

        return view('comments.index', compact('comments'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentRequest $request)
    {
        $post = Post::findOrFail($request->post_id);

        $comment = auth()->user()->comments()->create($request->validated());

        /** only send notification when user commented another user comments.*/
        if ($comment->post->author->id != auth()->id()) {
            $comment->post->author->notify(new PostCommentNotification($post, $comment));
        }

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
        /**
         * if user want to edit another user comment
         */
        if (auth()->id() !== $comment->user_id) {
            return abort(404);
        }

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
        $comment->update($request->validated());

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
        /**
         * if user want to edit delete user comment
         */
        if (auth()->id() !== $comment->user_id) {
            return abort(404);
        }

        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted.');
    }
}
