@extends('layouts.app')

@section('title', 'Your Posts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Post</li>
                    </ol>
                </nav>

                @include('partials.alert')
            </div>

            <div class="col-md-8 mb-3">
                <h4 class="float-left">All Your Posts</h4>

                <a href="{{ route('post.create') }}" class="btn btn-outline-primary float-right">
                    <i class="fas fa-plus"></i>
                    Create New Post
                </a>
            </div>

            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Title</th>
                            <th>Comments</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @forelse ($posts as $post)
                                <tr>
                                    <td>{{ ($posts->currentPage() - 1)  * $posts->links()->paginator->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('post.show', $post->slug) }}">{{ Str::limit($post->title, 100) }}</a>
                                    </td>
                                    <td>{{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count) }}
                                    </td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('post.edit', $post->slug) }}"
                                            class="btn btn-outline-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('post.destroy', $post->slug) }}" method="POST"
                                            onsubmit="return confirm('Are you sure want to delete this post?')">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="slug" value="{{ $post->slug }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Posts not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
