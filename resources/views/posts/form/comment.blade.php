@auth
    <div class="card mt-4">
        <div class="card-body">
            <form action="{{ route('comment.store') }}" method="POST">
                @csrf
                @method('POST')

                <input type="hidden" name="post_id" value="{{ $post }}">

                <div class="form-group">
                    <label for="body">Write Comment</label>

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
    <div class="card mt-4">
        <div class="card-body">
            <p class="font-weight-bold text-secondary mb-0 text-center">
                You must be <a href="/login">logged in</a> to write a comment.
            </p>
        </div>
    </div>
@endguest
