@if ($topics->count())
    @foreach($topics as $topic)
        <div class="post" style="cursor: pointer; margin-bottom: 20px" onclick="window.location='{{ url("/topics/view/" . $topic->id) }}'">
            <h2 style="font-size: 28px; margin: 0 0 10px;">{{ $topic->topic_title }}</h2>
            <p style="font-size: 20px">Comments: {{ $topic->comments }}</p>
        </div>
        <div class="arrow">
            <img src="{{ asset("assets/arrow.png") }}" alt="arrow.png" width="100" height="auto">
        </div>
        <div class="post" style="margin-bottom: 20px" onclick="window.location='{{ url("/topics/view/" . $topic->id) }}'">
            <h2 style="font-size: 22px; margin: 0 0 10px;">Last comment:</h2>
            @if (isset($last_comments_times[$topic->id]))
                <div class="post-header" style="font-size: 15px; color: #727171">
                    {{ $last_comments_times[$topic->id] }}
                </div>
            @endif
            <p style="font-size: 20px" id="text_container">{{ $last_comments[$topic->id] ?? "No comments yet." }}</p>
        </div>
    @endforeach
@else
    <h2>No topics found.</h2>
@endif
