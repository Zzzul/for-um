@extends('layouts.app')

@section('title', 'Edit comment - ' . $comment->body)

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-8 mb-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('comment.index') }}">Comment</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $comment->body }}
                        </li>
                    </ol>
                </nav>

                @include('partials.alert')

                {{-- card title and content of comments --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('comment.update', $comment->id) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="body">Comment</label>
                                <textarea class="form-control @error('body') is-invalid @enderror" name="body"
                                    id="body">{{ old('body') ?? $comment->body }}</textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-outline-primary">
                                <i class="fas fa-paper-plane"></i>
                                Update
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
