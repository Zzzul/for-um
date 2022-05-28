<?php

namespace App\Http\Controllers;

use App\Events\PostChanged;
use App\Http\Requests\StoreVoteRequest;
use App\Models\Post;

class VoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVoteRequest $request)
    {
        $query = auth()->user()->votes()->where('post_id', $request->post_id);

        $checVotes = $query->first();

        if ($checVotes) {
            if ($checVotes->type == $request->type) {
                //  if same vote type
                $query->delete();
            } else {
                // if different vote type, then delete old vote and save new vote
                $query->delete();

                // insert new vote
                auth()->user()->votes()->create($request->validated());
            }
        } else {
            // if not vote already
            auth()->user()->votes()->create($request->validated());
        }

        $post = Post::findOrFail($request->post_id);

        event(new PostChanged($post));

        return redirect()->back()->with('success', 'Vote saved.');
    }
}
