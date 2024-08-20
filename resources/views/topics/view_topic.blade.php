@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="header-actions" style="display: flex; justify-content: space-between;">
            <h1 style="font-size: 35px;">{{ $topic->topic_title }}</h1>
            <div style="display: flex;">
                @if ($topic->post_id != 0)
                <a href="{{ url("/posts/view/" . $topic->post_id) }}" class="create-post-button" style="cursor: pointer; margin-right: 10px;">View Permanent</a>
                @endif
                <a href="/topics" class="create-post-button" style="cursor: pointer;">Back</a>
            </div>
        </div>
        @if (session("success"))
            <div id="alert">
                <span>{{ session("success") }}</span>
            </div>
        @endif
        <div class="post-header" style="margin-top: -40px">
            <h3>Total comments: <span id="comment-counter">{{ $topic->comments }}</span></h3>
        </div>
        <div class="comments-section">
            <div id="comments" style="display: flex; flex-direction: column; gap: 10px; font-size: 20px">
                @foreach($comments as $comment)
                    <div class="comment">
                        <div class="post-header" style="font-size: 15px; color: #727171">
                            {{ $comment->added }}
                        </div>
                        <div class="post-content" style="word-break: break-all;">
                            {{ $comment->content }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="comment-input-section">
        <textarea type="text" id="comment-content" placeholder="Write a comment..." oninput="autoResize(this)" maxlength="255"></textarea>
        <a onclick="addComment()" class="create-comment-button">Send</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function addComment() {
            const content = document.getElementById('comment-content').value;
            const date = new Date();
            const day = String(date.getDate()).padStart(2, '0');
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const year = String(date.getFullYear());
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');
            const added = `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
            const topicId = {{ $topic->id }};
            const postId = {{ $topic->post_id }};

            axios.post('{{ url("/comments/add") }}', {
                topic_id: topicId,
                post_id: postId,
                content: content,
                added: added
            }).then(response => {
                const comment = response.data;
                const commentsDiv = document.getElementById('comments');
                const newCommentDiv = document.createElement('div');
                const newCommentHeader = document.createElement('div');
                const newCommentBody = document.createElement('div');
                newCommentDiv.classList.add('comment');
                newCommentBody.classList.add('post-content');
                newCommentHeader.classList.add('post-header');
                newCommentHeader.style.fontSize = "15px";
                newCommentHeader.style.color = "#727171";
                newCommentBody.innerText = comment.content;
                newCommentHeader.innerText = comment.added;
                newCommentDiv.appendChild(newCommentHeader);
                newCommentDiv.appendChild(newCommentBody);
                commentsDiv.appendChild(newCommentDiv);
                document.getElementById('comment-content').value = '';
                document.getElementById('comment-counter').innerText = parseInt(document.getElementById('comment-counter').innerText) + 1;
            }).catch(error => {
                console.error(error);
            });
        }
    </script>
@endsection
