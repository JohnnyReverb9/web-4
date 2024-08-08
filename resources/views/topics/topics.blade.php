@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            <h1 style="font-size: 34px; margin: 0;">Topics</h1>
            <div style="display: flex; justify-content: flex-end;">
                <input type="text" id="search_input" name="search_input" class="search-input" maxLength="45" style="font-size: 18px; margin-right: 10px" placeholder="Topic Title">
                <a id="search_button" class="create-post-button" style="cursor: pointer; margin-right: 10px">Search</a>
                <a href="{{ url('/permanent') }}" class="create-post-button">To Permanents</a>
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
            let notification = $("#alert");
            notification.css({
                position: 'fixed',
                bottom: '65px',
                right: '20px',
                backgroundColor: 'whitesmoke',
                color: 'black',
                padding: '10px 20px',
                borderRadius: '5px',
                zIndex: '1000',
                opacity: '1',
                transition: 'opacity 1s ease-in-out'
            });
            $('body').append(notification);
            setTimeout(function () {
                notification.css('opacity', '0');
                setTimeout(function () {
                    notification.remove();
                }, 1000);
            }, 1000);

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
