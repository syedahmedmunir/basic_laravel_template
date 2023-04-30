<!-- BASIC PROJECT BY SYED AHMED MUNIR-->

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    @include('layout.header')

</head>

<body>
    @include('layout.top_bar')

    @include('layout.side_bar')


    <div id="main">
        @yield('content')
    </div>

    @include('layout.footer')
    
</body>

</html>
