@extends('layouts.app')

@section('title', 'Your Reply')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Reply</li>
                    </ol>
                </nav>

                @include('partials.alert')
            </div>

            <div class="col-md-8 mb-3">
                <h4 class="float-left">All Your Reply</h4>
            </div>

            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead>
                            <th>#</th>
                            <th>Reply <small>(You)</small></th>
                            <th>Comment</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            @forelse ($replies as $reply)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $reply->body }}</td>
                                    <td>
                                        <a href="{{ route('post.show', $reply->comment->post->slug) }}">
                                            <span class="font-weight-bold">
                                                {{ $reply->comment->user->name }} -
                                            </span>
                                            {{ $reply->comment->body }}
                                        </a>
                                    </td>
                                    <td>{{ $reply->created_at->diffForHumans() }}</td>
                                    <td>{{ $reply->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ route('reply.edit', $reply->id) }}"
                                            class="btn btn-outline-info btn-sm mb-1">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('reply.destroy', $reply->id) }}" method="POST">
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
                                    <td colspan="7" class="text-center">reply not found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    {{ $replies->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
