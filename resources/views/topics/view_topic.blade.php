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

        <div class="comments-section">
            <div id="comments">
                @foreach($comments as $comment)
                    <div class="comment">{{ $comment->content }}</div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="comment-input-section" style="position: fixed; margin-bottom: 100px; bottom: 0; width: 500px; background: white; padding: 10px; box-shadow: 0 -2px 5px rgba(0,0,0,0.1);">
        <input type="text" id="comment-content" placeholder="Write a comment..." style="width: 80%; padding: 10px;">
        <button onclick="addComment()" class="create-post-button" style="padding: 10px 20px;">Send</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function addComment() {
            const content = document.getElementById('comment-content').value;
            const topicId = {{ $topic->id }};
            const postId = {{ $topic->post_id }};

            axios.post('{{ url("/comments/add") }}', {
                topic_id: topicId,
                post_id: postId,
                content: content
            }).then(response => {
                const comment = response.data;
                const commentsDiv = document.getElementById('comments');
                const newCommentDiv = document.createElement('div');
                newCommentDiv.classList.add('comment');
                newCommentDiv.innerText = comment.content;
                commentsDiv.appendChild(newCommentDiv);
                document.getElementById('comment-content').value = '';
            }).catch(error => {
                console.error(error);
            });
        }
    </script>
@endsection
