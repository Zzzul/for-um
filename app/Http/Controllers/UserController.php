<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
        // dd(auth()->user()->notifications->first()->data['comment']['body']);
        return view('users.notification');
    }

    /**
     * Mark as read for specific notification
     *
     * @param  int  $id
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function markAsReadNotification($id, $slug)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->firstOrFail();

        if ($notification->read_at == null) {
            $notification->markAsRead();
        }

        $post = Post::where('slug', $slug)->firstOrfail();

        return redirect()->route('post.show', $post->slug);
    }
}
