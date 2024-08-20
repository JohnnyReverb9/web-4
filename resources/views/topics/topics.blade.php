@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0;">Topics</h1>
            <div style="display: flex; justify-content: flex-end;">
                <input type="text" id="search_input" name="search_input" class="search-input" maxLength="45" style="font-size: 18px; margin-right: 10px" placeholder="Topic Title">
                <a id="search_button" class="create-post-button" style="cursor: pointer; margin-right: 10px">Search</a>
                <a href="{{ url('/permanent') }}" class="create-post-button" style="cursor: pointer; margin-right: 10px">To Permanents</a>
                <a href="{{ url('/topics/create') }}" class="create-post-button" >Create Topic</a>
            </div>
        </div>
        @if (session("success"))
            <div id="alert">
                <span>{{ session("success") }}</span>
            </div>
        @endif
        <div class="topics-list" style="margin-top: 20px; display: grid; grid-template-columns: repeat(3, 1fr);" id="search_results">
            @include("topics/search/topics_index", ["topics" => $topics, "last_comments" => $last_comments])
        </div>
    </div>
    <script>
        $(document).ready(function() {
            function search() {
                var query = $('#search_input').val();
                $.ajax({
                    url: '{{ url('/topics') }}',
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
