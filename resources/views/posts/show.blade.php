@extends('layouts.app')

@section('title', $post->author->name . ' - ' . $post->title)

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8 mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Post</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                    </ol>
                </nav>

                @include('partials.alert')

                {{-- card title and content of posts --}}
                <div class="card shadow-sm">
                    <div class="card-header">
                        <small>
                            <span class="font-weight-bold">
                                {{ $post->author->name }}
                                -
                                {{ $post->created_at->diffForHumans() }}
                            </span>

                            <span class="text-secondary">
                                {{ $post->created_at != $post->updated_at ? '(edited)' : '' }}
                            </span>
                        </small>

                        <small class="float-right text-secondary">
                            {{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count + 1) }}

                            @if (auth()->id() === $post->user_id)
                                <br>
                                <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-outline-info btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                            @endif
                        </small>

                        <br>

                        {{ $post->title }}
                    </div>

                    <div class="card-body">
                        {{ $post->content }}
                    </div>
                </div>

                {{-- form write comments --}}
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            @method('POST')

                            <input type="hidden" name="post_id" value="{{ $post->id }}">

                            <div class="row form-group">
                                <div class="col-md-10">
                                    <label for="body">Write Comment</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                                        placeholder="Nice posts!">{{ old('body') }}</textarea>
                                    @error('body')
                                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-2 mt-4 mb-2 pt-1">
                                    <button type="submit" class="btn btn-outline-primary btn-block h-100">
                                        <i class="fas fa-paper-plane"></i>
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <h4 class="mt-4 mb-2">All Comments</h4>
                <div class="card">
                    <div class="card-body">
                        @forelse ($post->comments as $comment)
                            <div class="mb-2">
                                <span class="font-weight-bold">{{ $comment->user->name }}</span> -
                                {{ $comment->created_at->diffForHumans() }}

                                <br>

                                <p> {{ $comment->body }}</p>

                                <div class="d-flex justify-content-between">
                                    <a data-toggle="collapse" href="#collapseReply-{{ $comment->id }}"
                                        aria-expanded="false" role="button"
                                        aria-controls="collapseReply-{{ $comment->id }}">
                                        Reply
                                    </a>

                                    <p class="mb-0 text-secondary">
                                        {{ $comment->replies_count > 0 ? $comment->replies_count . ' ' . Str::plural('Reply', $comment->replies_count) : '' }}
                                    </p>
                                </div>

                                <div class=" collapse mt-2" id="collapseReply-{{ $comment->id }}">
                                    <form action="{{ route('reply.store') }}" method="POST">
                                        @csrf
                                        @method('POST')

                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">

                                        <div class="form-group mb-2">
                                            <textarea class="form-control @error('reply') is-invalid @enderror" name="reply"
                                                id="reply" placeholder="Nice comment bro!">{{ old('reply') }}</textarea>
                                            @error('reply')
                                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-outline-primary">
                                                <i class="fas fa-paper-plane"></i>
                                                Send
                                            </button>
                                        </div>
                                    </form>

                                    <div class="ml-5">
                                        @foreach ($comment->replies as $reply)
                                            <hr class="ml-4">

                                            <span class="font-weight-bold ml-4">{{ $reply->user->name }}</span> -
                                            {{ $reply->created_at->diffForHumans() }}

                                            <p class="ml-4">{{ $reply->body }}</p>
                                        @endforeach
                                    </div>
                                </div>

                                <hr>

                            </div>
                        @empty
                            <p class="font-weight-bold text-secondary mb-0 text-center">
                                This post doesnt have comment.
                            </p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
