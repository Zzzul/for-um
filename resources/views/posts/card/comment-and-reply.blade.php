<div class="card">
    <div class="card-body p-3">
        @forelse ($post->comments as $comment)
            <div class="p-2" id="comment={{ $comment->id }}">
                <div class="d-flex justify-content-between mb-0">
                    <p class="my-0 mb-0">
                        <span class="font-weight-bold">
                            @if ($comment->user->avatar)
                                <img src="{{ asset('storage/img/avatar/' . $comment->user->avatar) }}" alt="Avatar"
                                    class="img-fluid rounded-circle"
                                    style="width: 15px; height: 15px; object-fit: cover;">
                            @else
                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->user->email))) . '?s=' . 15 }}"
                                    alt="Avatar" width="15" class="img-fluid rounded-circle">
                            @endif

                            {{ $comment->user->name }}

                        </span>

                        <br>

                        <small class="text-secondary ml-3 mb-0">
                            &nbsp;
                            {{ $comment->created_at->diffForHumans() }}

                            {{ $comment->created_at != $comment->updated_at ? '(edited)' : '' }}
                        </small>
                    </p>

                    @if (auth()->id() === $comment->user_id)
                        <span>
                            <a href="{{ route('comment.edit', $comment->id) }}" class="float-left mr-1">
                                <button class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </a>

                            <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                class="float-right"
                                onsubmit="return confirm('Are you sure want to delete this comment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </span>
                    @endif
                </div>

                <div class="ml-3 pl-1 mt-0">
                    {!! $comment->body !!}
                </div>

                <div class="d-flex justify-content-between mb-0">
                    <a class="mt-2 mb-1" data-toggle="collapse" href="#collapseReply-{{ $comment->id }}"
                        aria-expanded="false" role="button" aria-controls="collapseReply-{{ $comment->id }}">
                        <i class="fas fa-reply"></i> Reply
                    </a>

                    <p class="mb-0 text-secondary">
                        {{ $comment->replies_count > 0 ? $comment->replies_count . ' ' . Str::plural('Reply', $comment->replies_count) : '' }}
                    </p>
                </div>

                <div class="mt-2 collapse" id="collapseReply-{{ $comment->id }}">
                    @include('posts.form.reply', ['comment', $comment->id, 'post' => $post])

                    <div class="ml-5">
                        @foreach ($comment->replies as $reply)
                            <hr class="ml-4 m-0">

                            <div class="d-flex justify-content-between mb-0 py-3 px-0"
                                id="comment={{ $comment->id }}&reply={{ $reply->id }}">
                                <div>
                                    <span class="font-weight-bold ml-4">
                                        @if ($reply->user->avatar)
                                            <img src="{{ asset('storage/img/avatar/' . $reply->user->avatar) }}"
                                                alt="Avatar" class="img-fluid rounded-circle"
                                                style="width: 15px; height: 15px; object-fit: cover;">
                                        @else
                                            <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($reply->user->email))) . '?s=' . 15 }}"
                                                alt="Avatar" width="15" class="img-fluid rounded-circle">
                                        @endif

                                        {{ $reply->user->name }}
                                    </span>

                                    <br>

                                    <small class="text-secondary ml-4 pl-2">
                                        &nbsp;&nbsp;&nbsp;
                                        {{ $reply->created_at->diffForHumans() }}

                                        {{ $reply->created_at != $reply->updated_at ? '(edited)' : '' }}
                                    </small>

                                    <div class="ml-4 px-3">
                                        {!! $reply->body !!}
                                    </div>
                                </div>

                                @if (auth()->id() === $reply->user_id)
                                    <div class="mx-2">
                                        <span>
                                            <a href="{{ route('reply.edit', $reply->id) }}" class="float-left ml-2">
                                                <button class="btn btn-outline-info btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            </a>

                                            &nbsp;

                                            <form action="{{ route('reply.destroy', $reply->id) }}" method="POST"
                                                class="float-right"
                                                onsubmit="return confirm('Are you sure want to delete this reply?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <hr class="mt-3 mb-1">
            </div>
        @empty
            <p class="font-weight-bold text-secondary mb-0 text-center">
                This post does not have any comments.
            </p>
        @endforelse
    </div>
</div>
