@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0;">Settings</h1>
{{--            <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>--}}
        </div>
        <div class="post-view">
            <div class="post-header">
                <h1 style="font-size: 32px; margin-bottom: 20px">Download</h1>
            </div>
            <div class="posts-grid" style="grid-template-columns: repeat(5, 1fr);">
                <a href="/settings/download_all" class="create-post-button" style="text-align: center">All</a>
                <a href="/settings/download_posts_permanents" class="create-post-button" style="text-align: center">Posts&Permanents</a>
                <a href="/settings/download_posts" class="create-post-button" style="text-align: center">Posts</a>
                <a href="/settings/download_permanents" class="create-post-button" style="text-align: center">Permanents</a>
                <a href="/settings/download_topics" class="create-post-button" style="text-align: center">Topics</a>
            </div>
            <div class="post-header">
                <h1 style="font-size: 32px; margin-bottom: 20px">Stats</h1>
            </div>
            <div class="post-content" style="margin-top: -30px">

            </div>
            <div class="post-header" style="margin-top: 30px">
                <h1 style="font-size: 32px;">Contacts</h1>
            </div>
            <div class="post-content" style="margin-top: -30px">
                <p>Telegram: <a href="https://t.me/Johnny_Reverb" id="profile-link">&#64;Johnny_Reverb</a></p>
            </div>
        </div>
    </div>

@endsection
