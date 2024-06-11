@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>
        </div>
        <div class="posts-grid">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="post" style="position: relative; cursor: pointer;" onclick="window.location='{{ url('/posts/view', $post->id) }}';">
                        <div style="display: flex; align-items: center;">
                            <h2>{{ $post->title }}</h2>
                            <a href="{{ url('/posts/edit/' . $post->id) }}" class="edit-button" style="position: absolute; right: 10px; top: 36px;">
                                <img src="{{ asset("assets/pencil.svg") }}" width="17" height="17">
                            </a>
                            <a href="{{ url('/posts/delete/' . $post->id) }}" class="delete-button" style="position: absolute; right: 35px; top: 36px;">
                                <img src="{{ asset("assets/trash.svg") }}" width="19" height="19">
                            </a>
                        </div>
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
