<form action="{{ route('reply.store') }}" method="POST" class="m-0">
    @csrf
    @method('POST')

    <input type="hidden" name="comment_id" value="{{ $comment }}">

    <div class="form-group mb-2">
        <textarea class="form-control @error('reply') is-invalid @enderror" name="reply"
            placeholder="{{ auth()->check() ? 'Nice comment bro!' : 'You must be login.' }}" autofocus @guest disabled
            @endguest>{{ old('reply') }}</textarea>
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
