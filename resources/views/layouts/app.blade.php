<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asocial Network</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset("js/autoresize_textarea.js") }}"></script>
    <script src="{{ asset("js/textarea_resize.js") }}"></script>
    <script src="{{ asset("js/footer.js") }}"></script>
    <script src="{{ asset("js/go_back.js") }}"></script>
</head>
<body>
<header>
    <div>
        <h1 style="font-size: 36px">Asocial Network</h1>
        <nav style="font-size: 22px">
            <a href="/">Main</a>
            <a href="/posts">Posts</a>
            <a href="/permanent">Permanents</a>
            <a href="/topics">Topics</a>
            <a href="/settings">Settings</a>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
<footer>
    <p>&copy; {{ now()->format("Y") }} Asocial Network <span id="ver">v1.0.2</span></p>
</footer>
</body>
</html>
