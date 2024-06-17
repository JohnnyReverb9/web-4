@extends("layouts.app")

@section("content")

<div class="container">
    <div class="header-actions">
        <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>
    </div>
    <div class="posts-grid">
        @if($archived_posts->count())
            @foreach($archived_posts as $post)
                <div class="post" style="position: relative; cursor: pointer;"  onclick="window.location='{{ url('/posts/view', $post->id) }}';">
                    <h2>{{ $post->title }}</h2>
                    <p id="text_container">{{ $post->content }}</p>
                    @if(!is_null($post->image))
                        <img src="{{ asset("storage/" . $post->image) }}" width="auto" height="150" alt="{{ $post->title }}">
                    @endif
                </div>
            @endforeach
        @else
            <h1>No posts found.</h1>
        @endif
    </div>
</div>

@endsection