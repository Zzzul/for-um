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
                <table class="table table-hover table-striped">
                    <thead>
                        <th>#</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Comments</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                                </td>
                                <td>{{ Str::limit($post->content, 100) }}</td>
                                <td>{{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count) }}</td>
                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                <td>{{ $post->updated_at->diffForHumans() }}</td>
                                <td>
                                    <a href="{{ route('post.edit', $post->slug) }}"
                                        class="btn btn-outline-info btn-sm mb-1">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- <a href="#" data-id={{ $post->slug }} class="btn btn-danger delete"
                                        data-toggle="modal" data-target="#deleteModal">Delete</a> --}}

                                    <form action="{{ route('post.destroy', $post->slug) }}" method="POST">
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
                                <td colspan="5" class="text-center">Posts not found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Delete Warning Modal -->
    <div class="modal modal-danger fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="Delete"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('post.destroy', '1') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input id="id" name="id" type="hidden">

                        <h5>Are you sure you want to delete this post?</h5>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).on('click', '.delete', function() {
        let id = $(this).attr('data-id');
        $('#id').val(id);
        console.log(id);
    });
</script>
@endsection
