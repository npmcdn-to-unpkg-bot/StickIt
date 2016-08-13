<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Stick It - Note Taking Made Easy</title>

    <link href="{{ elixir('css/stick.it.css','/') }}" rel="stylesheet">
</head>

<body id="app-layout" >

    @yield('content')

    <script src="{{ elixir('js/stick.it.js','/') }}"></script>

    @include('sweet::alert')
</body>
</html>
