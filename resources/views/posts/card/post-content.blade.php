<div class="card shadow-sm">
    <div class="card-header">
        <small>
            <span class="font-weight-bold">
                @if ($post->author->avatar)
                    <img src="{{ asset('storage/img/avatar/' . $post->author->avatar) }}" alt="Avatar"
                        class="img-fluid rounded-circle" style="width: 15px; height: 15px; object-fit: cover;">
                @else
                    <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($post->author->email))) . '?s=' . 15 }}"
                        alt="Avatar" width="15" class="img-fluid rounded-circle">
                @endif

                {{ $post->author->name }}
                -
                {{ $post->created_at->diffForHumans() }}
            </span>

            <span class="text-secondary">
                {{ $post->created_at != $post->updated_at ? '(edited)' : '' }}
            </span>
        </small>

        <small class="float-right text-secondary">
            {{ $post->comments_count . ' ' . Str::plural('Comment', $post->comments_count + 1) }}

            @if (auth()->id() === $post->user_id)
                <br>
                <a href="{{ route('post.edit', $post->slug) }}" class="btn btn-outline-info btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
            @endif
        </small>

        <br>

        {{ $post->title }}
    </div>

    <div class="card-body">
        {!! $post->content !!}
    </div>
</div>
