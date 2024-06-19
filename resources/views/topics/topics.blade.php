@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0;">Topics</h1>
            <a href="{{ url('/permanent') }}" class="create-post-button">To Permanents</a>
        </div>
        <div class="topics-list" style="margin-top: 20px">
            @if ($topics->count())
                @foreach($topics as $topic)
                    <div class="post" style="cursor: pointer; margin-bottom: 20px" onclick="window.location='{{ url("/topics/view/" . $topic->post_id) }}'">
                        <h2 style="font-size: 28px; margin: 0 0 10px;">{{ $topic->topic_title }}</h2>
                        <p style="font-size: 20px">Comments: {{ $topic->comments }}</p>
                    </div>
                @endforeach
            @else
                <h2>No topics found.</h2>
            @endif
        </div>
    </div>

@endsection
