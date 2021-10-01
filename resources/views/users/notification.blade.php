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
                                <a href="{{ route('notification.markAsRead', ['id' => $notification->id, 'slug' => $notification->data['post']['slug']]) }}"
                                    class="{{ $notification->read_at ? 'text-dark' : '' }}">
                                    <p class="mb-0">
                                        <span class="font-weight-bold">
                                            {{ $notification->data['comment']['user']['name'] }}
                                        </span>
                                        commented your post
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            </li>
                        @else
                            {{-- reply notification --}}
                            <li class="list-group-item{{ $notification->read_at ? ' bg-secondary' : '' }}">
                                <a href="{{ route('notification.markAsRead', ['id' => $notification->id, 'slug' => $notification->data['comment']['post']['slug']]) }}"
                                    class="{{ $notification->read_at ? 'text-dark' : '' }}">
                                    <p class="mb-0">
                                        <span class="font-weight-bold">
                                            {{ $notification->data['reply']['user']['name'] }}
                                        </span>
                                        replied your comment
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
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
