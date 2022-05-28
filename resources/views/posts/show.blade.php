@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('post.index') }}">Post</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $post->title }}
                        </li>
                    </ol>
                </nav>

                @include('partials.alert')
            </div>
        </div>

        {{-- Desktop votes --}}
        <div class="d-none d-md-block">
            <div class="row justify-content-center mt-0">
                <div class="col-md-1">
                    <div class="card">
                        <div class="card-body pl-3 text-center">
                            <form action="{{ route('vote.store') }}" class="d-flex form-inline" method="POST">
                                @csrf
                                @method('post')

                                <div class="{{ $hasVote == 'up' ? 'text-primary' : 'text-secondary' }}">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                                    <input type="hidden" name="type" value="1">

                                    <button
                                        class="btn btn-transparent p-1{{ $hasVote == 'up' ? ' text-primary' : ' text-secondary' }}"
                                        type="submit">
                                        <h5>{{ $post->up_votes_count }}</h5>
                                        <i class="fas fa-sort-up fa-3x"></i>
                                    </button>
                                </div>
                            </form>

                            <form action="{{ route('vote.store') }}" class="d-flex form-inline" method="POST">
                                @csrf
                                @method('post')

                                <div class="{{ $hasVote == 'down' ? 'text-primary' : 'text-secondary' }}">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">

                                    <input type="hidden" name="type" value="0">

                                    <button
                                        class="btn btn-transparent p-1{{ $hasVote == 'down' ? ' text-primary' : ' text-secondary' }}"
                                        type="submit">
                                        <i class="fas fa-sort-down fa-3x"></i>

                                        <h5>{{ $post->down_votes_count }}</h5>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    @include('posts.card.post-content', ['post' => $post])
                </div>
            </div>
        </div>

        {{-- Mobile votes --}}
        <div class="d-sm-block d-md-none">
            <div class="row justify-content-center mt-0">
                <div class="col-md-12">
                    @include('posts.card.post-content', ['post' => $post])
                </div>

                <div class="col-md-12 mt-3">
                    <h4 class="mt-1">Votes</h4>
                    <div class="card">
                        <div class="card-body py-1 px-5 d-flex justify-content-between">
                            <div class="ml-5">
                                <form action="{{ route('vote.store') }}" method="POST">
                                    @csrf
                                    @method('post')

                                    <div class="{{ $hasVote == 'up' ? 'text-primary' : 'text-secondary' }}">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                                        <input type="hidden" name="type" value="1">

                                        <button
                                            class="btn btn-transparent p-1{{ $hasVote == 'up' ? ' text-primary' : ' text-secondary' }}"
                                            type="submit">
                                            <h5 class="float-left mr-2 mt-3">{{ $post->up_votes_count }}</h5>

                                            <i class="fas fa-sort-up fa-3x float-right mt-3"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                            <div class="mr-5">
                                <form action="{{ route('vote.store') }}" method="POST">
                                    @csrf
                                    @method('post')

                                    <div class="{{ $hasVote == 'down' ? 'text-primary' : 'text-secondary' }}">
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">

                                        <input type="hidden" name="type" value="0">

                                        <button
                                            class="btn btn-transparent p-1{{ $hasVote == 'down' ? ' text-primary' : ' text-secondary' }}"
                                            type="submit">

                                            <i class="fas fa-sort-down fa-3x float-left mr-2 mb-3"></i>

                                            <h5 class="float-right mt-3">{{ $post->down_votes_count }}</h5>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h4 class="mt-4">
                    Post a Comment
                </h4>
                @include('posts.form.comment', ['post' => $post])

                <h4 class="mt-4 mb-2">All Comments</h4>

                @include('posts.card.comment-and-reply', ['post' => $post])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function getHashValue(key) {
            var matches = location.hash.match(new RegExp(key + '=([^&]*)'))
            return matches ? matches[1] : null;
        }

        const commentId = getHashValue('comment')
        const replyId = getHashValue('reply')

        if (replyId !== null) {
            document.getElementById('collapseReply-' + commentId).classList.add('show')
        }

        const element = document.getElementById(window.location.hash.substr(1))
        headlineElement(element)

        function headlineElement(element) {
            element.style.backgroundColor = '#f7f7f7'
            element.style.border = '2px solid #158cba'
            element.style.borderRadius = '5px'

            element.addEventListener('mouseover', function() {
                setInterval(() => {
                    this.style.backgroundColor = 'white'
                    this.style.border = '0'
                    this.style.borderRadius = '0'
                }, 1000)
            })
        }
    </script>
@endsection

@include('partials.trix-editor')
