@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="header-actions">
            @if ($refer["title_btn"] === "Back")
                <h1></h1>
                <a onclick="goBack()" class="create-post-button" style="cursor: pointer;">{{ $refer["title_btn"] }}</a>
            @else
                <h1></h1>
                <a href="{{ url($refer["route"]) }}" class="create-post-button">{{ $refer["title_btn"] }}</a>
            @endif
        </div>
        <div>
            <h1 style="font-size: 34px">{{ $info }}</h1>
        </div>
    </div>

@endsection
