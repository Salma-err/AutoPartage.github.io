<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> Trace & Origin : Auto Partage</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/vue@next"></script>
</head>
<body>
    <div id="app">
       @include('partials.menu')
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        @include('partials.flash')
                    </div>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
    <script src="{{asset('pickdatetime.js')}}"></script>
</body>
</html>
