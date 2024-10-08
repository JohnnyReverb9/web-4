@if($archived_posts->count())
    @foreach($archived_posts as $post)
        <div class="post" style="position: relative; cursor: pointer" onclick="window.location='{{ url('/posts/view', $post->id) }}'">
            <h2 style="font-size: 28px">{{ $post->title }}</h2>
            <p id="text_container" style="font-size: 20px">{{ $post->content }}</p>
            @if(!is_null($post->image))
                <img src="{{ asset("storage/" . $post->image) }}" width="auto" height="150" alt="{{ $post->title }}" style="border-radius: 8px; justify-content: center; display: flex; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
            @endif
        </div>
    @endforeach
@else
    <h1>No Permanents found.</h1>
@endif
