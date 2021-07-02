@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ol>
                </nav>

                <h4 class="mt-3">All Posts</h4>
            </div>

            @forelse ($posts as $post)
                <div class="col-md-8 mb-4">
                    <a href="{{ route('post.show', $post->slug) }}" class="text-dark text-decoration-none">
                        <div class="card card-hover shadow-sm">
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

                                <small
                                    class="float-right text-secondary">{{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count) }}
                                </small>

                                <br>

                                {{ Str::limit($post->title, 100) }}
                            </div>

                            <div class="card-body">
                                {{ Str::limit($post->content, 400) }}
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        The posts is empty.
                    </div>
                </div>
            @endforelse

            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
