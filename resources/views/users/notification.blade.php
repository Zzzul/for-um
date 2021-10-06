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
                                            @if ($notification->data['comment']['user']['avatar'])
                                                <img src="{{ asset('storage/img/avatar/' . $notification->data['comment']['user']['avatar']) }}"
                                                    alt="Avatar" class="img-fluid rounded-circle"
                                                    style="width: 16px; height: 16px; object-fit: cover;">
                                            @else
                                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($notification->data['comment']['user']['email']))) . '?s=' . 70 }}"
                                                    alt="Avatar" width="15" class="img-fluid rounded-circle">
                                            @endif

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
                                            @if ($notification->data['reply']['user']['avatar'])
                                                <img src="{{ asset('storage/img/avatar/' . $notification->data['reply']['user']['avatar']) }}"
                                                    alt="Avatar" class="img-fluid rounded-circle"
                                                    style="width: 16px; height: 16px; object-fit: cover;">
                                            @else
                                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($notification->data['reply']['user']['email']))) . '?s=' . 70 }}"
                                                    alt="Avatar" width="15" class="img-fluid rounded-circle">
                                            @endif

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
