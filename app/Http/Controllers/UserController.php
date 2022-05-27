<?php

namespace App\Http\Controllers;

use App\Models\Post;

class UserController extends Controller
{
    /**
     * Display a listing of the notifications.
     *
     * @return \Illuminate\Http\Response
     */
    public function notification()
    {
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

        if ($notification->type == 'App\Notifications\PostCommentNotification') {
            return redirect()->route(
                'post.show',
                $post->slug . '#comment=' . $notification->data['comment']['id']
            );
        } else {
            return redirect()->route(
                'post.show',
                $post->slug . '#comment=' . $notification->data['comment']['id']
                    . '&reply=' . $notification->data['reply']['id']
            );
        }
    }
}
