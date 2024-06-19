@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0;">Topics</h1>
            <a href="{{ url('/topics/create') }}" class="create-post-button">Create topic</a>
        </div>
    </div>

@endsection
