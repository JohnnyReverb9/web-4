@extends("layouts.app")

@section("content")
    <div class="header-actions">
        <a href="{{ url("/posts") }}" class="create-post-button">Back</a>
    </div>
    <div class="form-container">
        <h1>Create Post</h1>
        <form action="{{ url('/posts/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" maxLength="45" style="font-size: 18px;" placeholder="Give a brief title for your post" required>
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="1" placeholder="Tell the story..." oninput="autoResize(this)"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" id="image" name="image" style="font-size: 18px;">
            </div>
            <div class="form-group">
                <label for="is_published">Permanent:</label>
                <input type="checkbox" id="is_published" name="is_published">
            </div>
            <button type="submit" class="submit-button">Create post</button>
        </form>
    </div>
    <script src="{{ asset("js/textarea_resize.js") }}"></script>
@endsection
