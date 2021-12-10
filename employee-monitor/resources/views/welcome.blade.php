<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <title>TPRN</title> --}}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #63c1fc;
            font-family: 'Nunito', sans-serif;
        }

        h1 {
            color: #e74c3c;
            font-family: 'Arial', sans-serif;
            font-weight: 300;
            font-size: 6rem;
            text-align: center;
            margin-top: 0;
        }

        .content {
            padding: 3rem 1rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            border-radius: 2rem;
        }

        .name {
            color: #111111;
            font-family: 'Arial', sans-serif;
            font-weight: 200;
            font-size: 2.5rem;
            text-align: center;
            align-items: center;
            justify-content: space-evenly;
            width: 60vw;
        }
    </style>
</head>
<body class="antialiased">
    <div class="content">
        <h1>BDT</h1>
        <div class="name">
            <span>HR Employee Monitoring</span>

            <div class="mt-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/home') }}" class="btn btn-lg btn-success">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-lg btn-success">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-lg btn-primary">Register</a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</body>
</html>
