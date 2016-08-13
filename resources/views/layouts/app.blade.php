<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="token" content="{{ csrf_token() }}">

    <title>@yield('title','Stick It - Note Taking Made Easy')</title>

    <link href="{{ elixir('css/stick.it.css','/') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">

    @yield('css')
</head>

<body id="@yield('body-id','app-layout')">
    @yield('modals')

    @yield('content')

    <script src="{{ elixir('js/stick.it.js','/') }}"></script>

    @yield('scripts')

    @include('sweet::alert')
</body>
</html>
