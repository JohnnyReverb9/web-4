@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0">Posts</h1>
            <div style="display: flex; justify-content: flex-end;">
                <input type="text" id="search_input" name="search_input" class="search-input" maxLength="45" style="font-size: 18px; margin-right: 10px" placeholder="Post Title">
                <a id="search_button" class="create-post-button" style="cursor: pointer; margin-right: 10px">Search</a>
                <a href="{{ url('/posts/create') }}" class="create-post-button" style="">Create post</a>
            </div>
        </div>
        @if (session("success"))
            <div id="alert">
                <span>{{ session("success") }}</span>
            </div>
        @endif
        <div class="posts-grid" id="search_results">
            @include("posts/search/index_content", ["posts" => $posts, "available_edit" => $available_edit])
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function search() {
                var query = $('#search_input').val();
                $.ajax({
                    url: '{{ url('/posts') }}',
                    type: 'GET',
                    data: { search: query },
                    success: function(response) {
                        $('#search_results').html(response.html);
                    }
                });
            }

            $('#search_button').on('click', function(e) {
                e.preventDefault();
                search();
            });

            $('#search_input').on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    search();
                }
            });
        });
    </script>

@endsection
