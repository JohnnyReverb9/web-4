@extends("layouts.app")

@section("content")
    <div class="header-actions">
        <a href="{{ url("/posts") }}" class="create-post-button">Back</a>
    </div>
    <div class="form-container">
        <h2>Create Post</h2>
        <form action="{{ url('/posts/create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" [maxLength]="70" required>
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <textarea id="content" name="content" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit" class="submit-button">Create post</button>
        </form>
    </div>
@endsection
