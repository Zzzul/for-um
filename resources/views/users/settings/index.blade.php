@extends('layouts.app')

@section('title', 'Setting')

@section('content')
    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Setting</li>
                    </ol>
                </nav>

                @include('partials.alert')
            </div>

            {{-- Profile --}}
            <div class="col-md-8 mt-3">
                @if (auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '')
                    <div class="alert alert-warning mb-4">
                        Demo account can't change profile information or password.
                    </div>
                @endif


                <div class="row">
                    <div class="col-md-3">
                        <h4>Profile</h5>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body pb-1">
                                <form action="{{ route('setting.ChangeProfile') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input id="name" type="text" name="name"
                                            value="{{ old('name') ?? auth()->user()->name }}" autocomplete="name"
                                            class="form-control @error('name') is-invalid @enderror" required
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>

                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" name="email"
                                            value="{{ old('email') ?? auth()->user()->email }}" autocomplete="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="row form-group">
                                        <div class="col-md-4 text-center mb-1">
                                            @if (auth()->user()->avatar)
                                                <img src="{{ asset('storage/img/avatar/' . auth()->user()->avatar) }}"
                                                    alt="Avatar" class="img-fluid rounded"
                                                    style="width: 100%; height: 99px; object-fit: cover;">
                                            @else
                                                <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(auth()->user()->email))) . '?s=' . 500 }}"
                                                    alt="Avatar" class="img-fluid rounded"
                                                    style="width: 100%; height: 100px; object-fit: cover;">
                                            @endif
                                        </div>

                                        <div class="col-md-8">
                                            <label for="avatar">
                                                Avatar
                                                <small class="text-secondary">(Leave it blank if you don't want to be
                                                    replaced)</small>
                                            </label>

                                            <input type="file" id="avatar"
                                                class="form-control @error('avatar') is-invalid @enderror" disabled>

                                            <small class="text-secondary">
                                                To try uploading a file, please <a href="https://github.com/Zzzul/for-um"
                                                    target="blank">install it on your local
                                                    machine</a> because
                                                Heroku doesn't support uploading files.
                                            </small>
                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary{{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? ' disabled' : '' }}"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 my-3">
                <hr>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3">
                        <h4>Change Password<h4>
                    </div>
                    <div class="col-md-9">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('setting.ChangePassword') }}" method="POST">
                                    @csrf
                                    @method('put')

                                    <div class="form-group">
                                        <label for="current_password">Current Password</label>
                                        <input id="current_password" type="password"
                                            class="form-control @error('current_password') is-invalid @enderror"
                                            name="current_password"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>

                                        @error('current_password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password">New Password</label>

                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            required autocomplete="new-password"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" required autocomplete="new-password"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>

                                        @error('password_confirmation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-primary{{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? ' disabled' : '' }}"
                                            {{ auth()->check() && auth()->user()->email == 'demo@mail.com' ? 'disabled' : '' }}>
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
