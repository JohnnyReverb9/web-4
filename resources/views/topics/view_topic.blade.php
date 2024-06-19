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
            <div id="comments" style="display: flex; flex-direction: column; gap: 10px; font-size: 20px">
                @foreach($comments as $comment)
                    <div class="comment" style="width: 25%; background: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 5px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                        {{ $comment->content }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="comment-input-section">
        <textarea type="text" id="comment-content" placeholder="Write a comment..." oninput="autoResize(this)"></textarea>
        <a onclick="addComment()" class="create-comment-button">Send</a>
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
                newCommentDiv.style.width = '25%';
                newCommentDiv.style.background = '#f9f9f9';
                newCommentDiv.style.padding = '10px';
                newCommentDiv.style.border = '1px solid #ddd';
                newCommentDiv.style.borderRadius = '5px';
                newCommentDiv.style.boxShadow = '0 1px 3px rgba(0,0,0,0.1)';
                newCommentDiv.style.marginBottom = '10px';
                newCommentDiv.style.fontSize = '20px';
                newCommentDiv.innerText = comment.content;
                commentsDiv.appendChild(newCommentDiv);
                document.getElementById('comment-content').value = '';
            }).catch(error => {
                console.error(error);
            });
        }
    </script>
@endsection
