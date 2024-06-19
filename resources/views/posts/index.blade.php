@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0">Posts</h1>
            <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>
        </div>
        <div class="posts-grid">
            @if($posts->count())
                @foreach($posts as $post)
                    <div class="post" style="position: relative; cursor: pointer;" onclick="window.location='{{ url('/posts/view', $post->id) }}';">
                        <div style="display: flex; align-items: center;">
                            <h2 style="font-size: 28px">{{ $post->title }}</h2>
                            <a href="{{ url('/posts/edit/' . $post->id) }}" class="edit-button" style="position: absolute; right: 10px; top: 24px;">
                                <img src="{{ asset("assets/pencil.svg") }}" width="19" height="19" alt="edit">
                            </a>
                            <a href="{{ url('/posts/delete/' . $post->id) }}" class="delete-button" style="position: absolute; right: 35px; top: 24px;">
                                <img src="{{ asset("assets/trash.svg") }}" width="21" height="21" alt="delete">
                            </a>
                        </div>
                        <p id="text_container" style="font-size: 20px">{{ $post->content }}</p>
                        @if(!is_null($post->image))
                            <img style="border-radius: 8px; justify-content: center; display: flex; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);" src="{{ asset("storage/" . $post->image) }}" width="auto" height="150" alt="{{ $post->title }}">
                        @endif
                    </div>
                @endforeach
            @else
                <h1>No posts found.</h1>
            @endif
        </div>
    </div>

@endsection
