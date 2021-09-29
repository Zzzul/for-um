<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVoteRequest;
use App\Models\Post;
use App\Models\Votes;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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

                auth()->user()->votes()->create($request->validated());
            }
        } else {
            // if not vote already
            auth()->user()->votes()->create($request->validated());
        }

        return redirect()->back()->with('success', 'Vote saved.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Votes  $votes
     * @return \Illuminate\Http\Response
     */
    public function show(Votes $votes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Votes  $votes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Votes $votes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Votes  $votes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Votes $votes)
    {
        //
    }
}
