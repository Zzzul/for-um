<div class="card mt-4">
    <div class="card-body">
        <form action="{{ route('comment.store') }}" method="POST">
            @csrf
            @method('POST')

            <input type="hidden" name="post_id" value="{{ $post }}">

            <div class="form-group">
                <label for="body">Write Comment</label>
                {{-- <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body"
                        placeholder="{{ auth()->check() ? 'Nice posts!' : 'You must be login.' }}" autofocus @guest
                        disabled @endguest>{{ old('body') }}</textarea> --}}

                <input id="body" value="{{ old('body') }}" type="hidden" name="body">
                <trix-editor input="body"></trix-editor>

                @error('body')
                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-outline-primary float-right" @guest disabled @endguest>
                <i class="fas fa-paper-plane"></i>
                Send
            </button>
        </form>
    </div>
</div>
