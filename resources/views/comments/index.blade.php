@extends('layouts.app')

@section('title', 'Your Comment')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comment</li>
                    </ol>
                </nav>

                @include('partials.alert')
            </div>

            <div class="col-md-8 mb-3">
                <h4 class="float-left">All Your Comment</h4>
            </div>

            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Comments <small>(You)</small></th>
                            <th>Post</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @forelse ($comments as $comment)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $comment->body }}</td>
                                    <td>
                                        <a href="{{ route('post.show', $comment->post->slug) }}">
                                            <span class="font-weight-bold">
                                                {{ $comment->post->author->name }} -
                                            </span>
                                            {{ $comment->post->title }}
                                        </a>
                                    </td>
                                    <td>{{ $comment->created_at->diffForHumans() }}</td>
                                    <td>{{ $comment->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('comment.edit', $comment->id) }}"
                                            class="btn btn-outline-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Comment not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
