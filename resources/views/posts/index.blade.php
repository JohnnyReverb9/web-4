<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Social Network</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header>
    <div>
        <h1>Social Network</h1>
        <nav>
            <a href="/">Main</a>
            <a href="/posts">Posts</a>
        </nav>
    </div>
</header>
<div class="container">
    <div class="posts-grid">
        @if($posts->count())
            @foreach($posts as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
</div>
</body>
</html>
