@if ($topics->count())
    @foreach($topics as $topic)
        <div class="post" style="cursor: pointer; margin-bottom: 20px" onclick="window.location='{{ url("/topics/view/" . $topic->post_id) }}'">
            <h2 style="font-size: 28px; margin: 0 0 10px;">{{ $topic->topic_title }}</h2>
            <p style="font-size: 20px">Comments: {{ $topic->comments }}</p>
        </div>
        <div class="post" style="margin-bottom: 20px" onclick="window.location='{{ url("/topics/view/" . $topic->post_id) }}'">
            <h2 style="font-size: 22px; margin: 0 0 10px;">Last comment:</h2>
            <p style="font-size: 20px">{{ $last_comments[$topic->id] ?? "No comments yet." }}</p>
        </div>
    @endforeach
@else
    <h2>No topics found.</h2>
@endif
