@extends("layouts.app")

@section("content")

<div class="container">
    <div class="posts-grid">
        @if($archived_posts->count())
            @foreach($archived_posts as $post)
                <div class="post">
                    <h2>{{ $post->title }}</h2>
                    <p>{{ $post->content }}</p>
                    @if(!is_null($post->image))
                        <img src="{{ asset("storage/" . $post->image) }}" width="auto" height="150" alt="{{ $post->title }}">
                    @endif
                </div>
            @endforeach
        @else
            <p>No posts found.</p>
        @endif
    </div>
</div>

@endsection
