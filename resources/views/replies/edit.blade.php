@extends('layouts.app')

@section('title', 'Edit Reply - ' . $reply->body)

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
                            <a href="{{ route('reply.index') }}">Reply</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $reply->body }}
                        </li>
                    </ol>
                </nav>

                @include('partials.alert')

                {{-- card title and content of reply --}}
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('reply.update', $reply->id) }}" method="POST">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <label for="reply">Reply</label>
                                <textarea class="form-control @error('reply') is-invalid @enderror" name="reply"
                                    id="reply">{{ old('reply') ?? $reply->body }}</textarea>
                                @error('reply')
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
