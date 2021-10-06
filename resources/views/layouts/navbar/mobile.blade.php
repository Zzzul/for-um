<div class="d-md-none d-lg-none d-xl-none p-0 mt-4">
    <nav class="navbar navbar-dark bg-primary navbar-expand fixed-bottom p-0">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item mt-1">
                <a href="{{ route('post.index') }}"
                    class="nav-link text-center{{ request()->routeIs('post.*') ? ' active' : '' }}">
                    <svg width="1.5em" height="1.5em" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        class="bi bi-journal-text" viewBox="0 0 16 16">
                        <path
                            d="M5 10.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0-2a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z" />
                        <path
                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                        <path
                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                    </svg>
                    <span class="mt-1 mb-0 small d-block">Post</span>
                </a>
            </li>

            <li class="nav-item mt-1">
                <a href="{{ route('home') }}"
                    class="nav-link text-center{{ request()->routeIs('home*') ? ' active' : '' }}">
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd"
                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                    <span class="mt-1 mb-0 small d-block">Home</span>
                </a>
            </li>

            @auth
                <li class="nav-item mt-1 dropup">
                    <a href="#"
                        class="nav-link text-center{{ request()->routeIs('notification') || request()->routeIs('setting.*') ? ' active' : '' }}"
                        role="button" id="dropdownMenuProfile" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">

                        @if (auth()->user()->avatar)
                            <img src="{{ asset('storage/img/avatar/' . auth()->user()->avatar) }}" alt="Avatar"
                                class="img-fluid rounded-circle" style="width: 20px; height: 20px; object-fit: cover;">
                        @else
                            <img src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim(auth()->user()->email))) . '?s=' . 50 }}"
                                alt="Avatar" width="27" class="img-fluid rounded-circle">
                        @endif

                        <span class="mt-1 mb-0 small d-block">Profile</span>
                    </a>
                    <!-- Dropup menu for profile -->
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuProfile">
                        <a class="dropdown-item{{ request()->routeIs('notification') ? ' active' : '' }}"
                            href="{{ route('notification') }}">
                            Notification

                            <span class="badge badge-secondary ml-1">
                                {{ auth()->user()->unreadNotifications->count() }}
                            </span>
                        </a>


                        <a class="dropdown-item{{ request()->routeIs('setting.*') ? ' active' : '' }}"
                            href="/setting">Setting</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            @endauth

            @guest
                <li class="nav-item mt-1">
                    <a href="{{ route('login') }}"
                        class="nav-link text-center{{ request()->routeIs('login') ? ' active' : '' }}">
                        <svg width="1.5em" height="1.5em" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z" />
                            <path fill-rule="evenodd"
                                d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                        </svg>
                        <span class="mt-1 mb-0 small d-block">Login</span>
                    </a>
                </li>

            @endguest
        </ul>
    </nav>
</div>
