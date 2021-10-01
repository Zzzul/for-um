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
            </div>

            <div class="col-md-8 mt-3">
                <form action="/" method="GET" class="row">
                    <div class="col-md-10 m-0">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search"
                                value="{{ request()->query('search') }}" placeholder="Username, title, or description">
                        </div>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="submit">
                            <i class="fas fa-search mr-1"></i>
                            Search
                        </button>
                    </div>
                </form>
            </div>

            <div class="col-md-8">
                <hr>
            </div>

            <div class="col-md-8">
                <h4 class="mt-2">All Posts</h4>
            </div>

            @forelse ($posts as $post)
                <div class="col-md-8 mb-4">
                    <a href="{{ route('post.show', $post->slug) }}" class="text-dark text-decoration-none">
                        <div class="card card-hover shadow-sm">
                            <div class="card-header">
                                <small>
                                    <span class="font-weight-bold">
                                        @if ($post->author->avatar)
                                            <img src="{{ asset('storage/img/avatar/' . $post->author->avatar) }}"
                                                alt="Avatar" class="img-fluid rounded-circle"
                                                style="width: 16px; height: 16px; object-fit: cover;">
                                        @else
                                            <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($post->author->email))) . '?s=' . 15 }}"
                                                alt="Avatar" width="15" class="img-fluid rounded-circle">
                                        @endif

                                        {{ $post->author->name }}
                                        -
                                        {{ $post->created_at->diffForHumans() }}
                                    </span>

                                    <span class="text-secondary">
                                        {{ $post->created_at != $post->updated_at ? '(edited)' : '' }}
                                    </span>
                                </small>

                                <small class="float-right text-secondary">
                                    {{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count) }}
                                </small>

                                <br>

                                {{ Str::limit($post->title, 100) }}
                            </div>

                            <div class="card-body">
                                {!! Str::limit($post->content, 400) !!}
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-md-8">
                    <div class="alert alert-danger">
                        Posts not found.
                    </div>
                </div>
            @endforelse

            <div class="col-md-8 mb-5">
                <div class="d-flex justify-content-center">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
