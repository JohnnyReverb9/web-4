@extends("layouts.app")

@section("content")

<div class="container">
    <div class="header-actions">
        <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>
    </div>
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

@endsection
