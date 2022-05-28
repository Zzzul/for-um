<?php

namespace App\Listeners;

use App\Events\PostChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class RemovePostCache
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\PostChanged  $event
     * @return void
     */
    public function handle(PostChanged $event)
    {
        Cache::forget(Str::slug('post_' . $event->post->slug));

        Cache::forget(Str::slug('vote_'. auth()->id() . '_' . $event->post->id));

        Cache::forget(Str::slug('post_' . $event->post->slug . '_edit'));
    }
}
