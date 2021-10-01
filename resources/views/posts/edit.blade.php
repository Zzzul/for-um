@extends('layouts.app')

@section('title', 'Edit Post - ' . $post->title)

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
                            <a href="{{ route('post.index') }}">Post</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            <a href="{{ route('post.show', $post->slug) }}">{{ $post->title }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>

                @include('partials.alert')

                {{-- card title and content of posts --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('post.update', $post->slug) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                                    id="title" value="{{ old('title') ?? $post->title }}"
                                    placeholder="Learn laravel notification">

                                @error('title')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="content">Content</label>

                                <input id="content" value="{{ old('content') ?? $post->content }}" type="hidden"
                                    name="content">

                                <trix-editor input="content"></trix-editor>

                                @error('content')
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

@include('partials.trix-editor')
