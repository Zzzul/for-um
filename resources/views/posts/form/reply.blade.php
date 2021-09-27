<form action="{{ route('reply.store') }}" method="POST" class="m-0">
    @csrf
    @method('POST')

    <input type="hidden" name="comment_id" value="{{ $comment->id }}">

    <div class="form-group mb-2">
        <input id="reply-{{ $comment->id }}" value="{{ old('reply-' . $comment->id) }}" type="hidden"
            name="reply-{{ $comment->id }}">
        <trix-editor input="reply-{{ $comment->id }}"></trix-editor>

        @error('reply')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-outline-primary" @guest disabled @endguest>
            <i class="fas fa-paper-plane"></i>
            Send
        </button>
    </div>
</form>
