@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="header-actions">
            <a href="{{ url('/posts') }}" class="create-post-button">Back</a>
        </div>
        <div class="post-view">
            <div class="post-header">
                <h1 style="font-size: 35px">{{ $post_info->title }}</h1>
                @if ($post_info->is_published)
                    <a href="{{ url('/posts/edit/' . $post_info->id) }}" class="edit-button">
                        <img src="{{ asset("assets/pencil.svg") }}" width="19" height="19" alt="edit">
                    </a>
                    <a href="{{ url('/posts/delete/' . $post_info->id) }}" class="delete-button">
                        <img src="{{ asset("assets/trash.svg") }}" width="21" height="21" alt="delete">
                    </a>
                @endif
            </div>
            <div class="post-content">
                <p>{{ $post_info->content }}</p>
                @if(!is_null($post_info->image))
                    <img src="{{ asset("storage/" . $post_info->image) }}" alt="{{ $post_info->title }}" width="500" height="auto">
                @endif
            </div>
        </div>
    </div>
@endsection
