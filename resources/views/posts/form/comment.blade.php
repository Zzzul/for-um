@auth
    <div class="card">
        <div class="card-body">
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="form-group">
                    <input id="body" value="{{ old('body') }}" type="hidden" name="body">
                    <trix-editor input="body"></trix-editor>

                    @error('body')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-outline-primary">
                        <i class="fas fa-paper-plane"></i>
                        Send
                    </button>
                </div>
            </form>
        </div>
    </div>
@endauth

@guest
    <div class="card">
        <div class="card-body">
            <p class="font-weight-bold text-secondary mb-0 text-center">
                You must be <a href="/login?goto={{ $post->slug }}">login</a> to post a comment.
            </p>
        </div>
    </div>
@endguest
