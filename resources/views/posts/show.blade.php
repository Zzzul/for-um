@extends('layouts.app')

@section('title', $post->title)

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
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $post->title }}
                        </li>
                    </ol>
                </nav>

                @include('partials.alert')

                @include('posts.card.post-content', ['post' => $post])

                @include('posts.form.comment', ['post' => $post->id])

                <h4 class="mt-4 mb-2">All Comments</h4>

                @include('posts.card.comment-and-reply', ['post' => $post])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const commentId = getQueryParams('comment')
        const replyId = getQueryParams('reply') ? getQueryParams('reply') : null

        const commentElement = document.getElementById('comment-' + commentId)
        const collapseReply = document.getElementById('collapseReply-' + commentId)
        const replyElement = document.getElementById('reply-' + replyId)

        if (replyId === null) {
            headlineElement(commentElement)
        } else {
            collapseReply.classList.add('show')
            headlineElement(replyElement)
        }

        function getQueryParams(name) {
            return (location.search.split(name + '=')[1] || '').split('&')[0];
        }

        function headlineElement(element) {
            element.style.backgroundColor = '#f7f7f7'
            element.style.border = '1px solid #158cba'
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
