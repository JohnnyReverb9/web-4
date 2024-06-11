@extends("layouts.app")

@section("content")

<div>
    <h1>Welcome!</h1>
</div>
<div class="stats-container">
    <div class="stats-item">
        <span>All posts:</span>
        <span>{{ $all_posts }}</span>
    </div>
    <div class="stats-item">
        <span>Published:</span>
        <span>{{ $published_posts }}</span>
    </div>
    <div class="stats-item">
        <span>Archived:</span>
        <span>{{ $archived_posts }}</span>
    </div>
</div>

@endsection
