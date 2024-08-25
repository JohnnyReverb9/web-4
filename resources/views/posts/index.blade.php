@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0">Posts</h1>
            <div style="display: flex; justify-content: flex-end;">
                <input type="text" id="search_input" name="search_input" class="search-input" maxLength="45" style="font-size: 18px; margin-right: 10px; outline: none;" placeholder="Post Title">
                <a id="search_button" class="create-post-button" style="cursor: pointer; margin-right: 10px">Search</a>
                <a href="{{ url('/posts/create') }}" class="create-post-button">Create post</a>
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
        @if($posts->hasMorePages())
            <div id="loading" style="display: none;">Loading...</div>
        @endif
    </div>
    <script>
        $(document).ready(function() {
            var page = 1;
            var loading = false;

            function search(page) {
                var query = $('#search_input').val();
                $.ajax({
                    url: '{{ url('/posts') }}',
                    type: 'GET',
                    data: { search: query, page: page },
                    success: function(response) {
                        $('#search_results').append(response.html);
                        if (response.next_page) {
                            $(window).data('next_page', response.next_page);
                        } else {
                            $(window).data('next_page', null);
                        }
                        loading = false;
                        $('#loading').hide();
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

            $('#search_button').on('click', function(e) {
                e.preventDefault();
                $('#search_results').empty();
                page = 1;
                search(page);
            });

            $('#search_input').on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    $('#search_results').empty();
                    page = 1;
                    search(page);
                }
            });

            $(window).on('scroll', function() {
                if ($(window).scrollTop() + $(window).height() > $(document).height() - 100 && !loading) {
                    var nextPageUrl = $(window).data('next_page');
                    if (nextPageUrl) {
                        loading = true;
                        $('#loading').show();
                        $.ajax({
                            url: nextPageUrl,
                            type: 'GET',
                            success: function(response) {
                                $('#search_results').append(response.html);
                                if (response.next_page) {
                                    $(window).data('next_page', response.next_page);
                                } else {
                                    $(window).data('next_page', null);
                                }
                                loading = false;
                                $('#loading').hide();
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', status, error);
                            }
                        });
                    }
                }
            });

            $(window).data('next_page', '{{ $posts->nextPageUrl() }}');
        });
    </script>
@endsection
