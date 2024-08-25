@extends("layouts.app")

@section("content")
    <div class="header-actions">
        <h1></h1>
        <a onclick="goBack()" class="create-post-button" style="cursor: pointer;">Back</a>
    </div>
    <div class="form-container">
        <h1>Create your independent Topic</h1>
        <form action="{{ url('/topics/create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="topic_title" maxLength="45" style="font-size: 18px; outline: none;" placeholder="Creative title for your Topic" autofocus required>
            </div>
            <button type="submit" class="submit-button">Create Topic</button>
        </form>
    </div>
@endsection
