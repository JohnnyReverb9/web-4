@extends("layouts.app")

@section("content")
    <div class="header-actions">
        <a href="{{ url("/posts") }}" class="create-post-button">Back</a>
    </div>
    <div class="form-container">
        <h1>Create Post</h1>
        <form action="{{ url('/posts/update/' . $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" maxLength="45" style="font-size: 18px;" placeholder="Give a brief title for your post" required value="{{ $post->title }}">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" placeholder="Tell the story..." oninput="autoResize(this)">{{ $post->content }}</textarea>
            </div>
            <div class="form-group">
                <label for="image">Current Image:</label><br>
                @if ($post->image)
                    <img src="{{ asset("storage/" . $post->image) }}" alt="Current Image" style="max-width: 300px; border-radius: 8px">
                    <br><br>
                @else
                    <span>No image uploaded</span>
                    <br><br>
                @endif
                <label for="new_image">New Image:</label>
                <input type="file" id="image" name="image" style="font-size: 18px;">
            </div>
            <div class="form-group">
                <label for="is_published">Delete current image:</label>
                <input type="checkbox" id="is_published" name="delete_image">
            </div>
            <button type="submit" class="submit-button">Update post</button>
        </form>
    </div>
    <script src="{{ asset("js/textarea_resize.js") }}"></script>
@endsection
