@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1></h1>
            <a onclick="goBack()" class="create-post-button" style="cursor: pointer;">Back</a>
        </div>
        <div class="post-header">
            <h1 style="font-size: 35px">{{ $topic->topic_title }}</h1>
        </div>
    </div>

@endsection
