<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asocial Network</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<header>
    <div>
        <h1 style="font-size: 36px">Asocial Network</h1>
        <nav style="font-size: 22px">
            <a href="/">Main</a>
            <a href="/posts">Posts</a>
            <a href="/permanent">Permanents</a>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        @yield('content')
    </div>
</main>
<footer>
    <p>&copy; 2024 Asocial Network</p>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset("js/footer.js") }}"></script>
</body>
</html>
