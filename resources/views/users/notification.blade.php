@extends('layouts.app')

@section('title', 'Notification')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Notifications</li>
                    </ol>
                </nav>

                <ul class="list-group shadow-sm">
                    @forelse (auth()->user()->notifications as $notification)

                        @if ($notification->type == 'App\Notifications\PostCommentNotification')
                            {{-- comment notification --}}
                            <li class="list-group-item{{ $notification->read_at ? ' bg-secondary' : '' }}">
                                <p class="mb-0">
                                    Your post
                                    <span class="font-weight-bold">
                                        {{ Str::limit($notification->data['post']['title'], 75) }}</span>
                                    received a new comments - {{ $notification->created_at->diffForHumans() }}
                                </p>

                                {{-- <a href="/post/{{ $notification->data['post']['slug'] . '#' . $notification->data['comment']['id'] }}" --}}

                                <a href="{{ route('notification.markAsRead', ['id' => $notification->id, 'slug' => $notification->data['post']['slug']]) }}"
                                    class="{{ $notification->read_at ? 'text-dark' : '' }}">
                                    <span class="font-weight-bold">
                                        {{ $notification->data['comment']['user']['name'] }}
                                    </span>
                                    -
                                    {{ Str::limit($notification->data['comment']['body'], 300) }}
                                </a>
                            </li>
                        @else
                            {{-- reply notification --}}
                            <li class="list-group-item{{ $notification->read_at ? ' bg-secondary' : '' }}">
                                <p class="mb-0">
                                    Your comment
                                    <span class="font-weight-bold">
                                        {{ Str::limit($notification->data['comment']['body'], 75) }}</span>
                                    received a new reply - {{ $notification->created_at->diffForHumans() }}
                                </p>

                                <a href="{{ route('notification.markAsRead', ['id' => $notification->id, 'slug' => $notification->data['comment']['post']['slug']]) }}"
                                    class="{{ $notification->read_at ? 'text-dark' : '' }}">
                                    <span class="font-weight-bold">
                                        {{ $notification->data['reply']['user']['name'] }}
                                    </span>
                                    -
                                    {{ Str::limit($notification->data['reply']['body'], 300) }}
                                </a>
                            </li>
                        @endif

                    @empty
                        <li class="list-group-item">
                            No notification.
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>
    </div>
@endsection
