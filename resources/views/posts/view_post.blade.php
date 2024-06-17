@extends("layouts.app")

@section("content")
    <div class="container">
        @if ($post_info->is_published)
            <div class="header-actions">
                <a href="{{ url('/posts') }}" class="create-post-button">Back</a>
            </div>
        @else
            <div class="header-actions">
                <a href="{{ url('/permanent') }}" class="create-post-button">Back</a>
            </div>
        @endif
        <div class="post-view">
            <div class="post-header">
                <h1 style="font-size: 35px">{{ $post_info->title }}</h1>
                @if ($post_info->is_published)
                    <a href="{{ url('/posts/edit/' . $post_info->id) }}" class="edit-button">
                        <img src="{{ asset("assets/pencil.svg") }}" width="25" height="25" alt="edit" style="position: absolute; right: 20px; top: 49px;">
                    </a>
                    <a href="{{ url('/posts/delete/' . $post_info->id) }}" class="delete-button">
                        <img src="{{ asset("assets/trash.svg") }}" width="27" height="27" alt="delete" style="position: absolute; right: 53px; top: 49px;">
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