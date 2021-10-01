<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootswatch-lumen.min.css') }}" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('trix-editor')
</head>

<body>
    <div id="app">
        @include('layouts.navbar.desktop')

        {{-- Mobile header --}}
        <div class="d-sm-block d-md-none">
            <nav class="navbar navbar-dark bg-primary">
                <span class="navbar-brand mb-0 h1">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </nav>
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Mobile Navbar -->
    @include('layouts.navbar.mobile')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>

</html>
