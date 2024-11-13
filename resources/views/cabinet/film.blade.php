@extends('layouts.front')
@section('content')

<main class="cabinet">
    <div class="content wrapper">
        <x-cabinet-navigation />

        <div class="cabinet-subtitle">{!! __('site.film') !!}</div>

        <div class="video-container">
            <iframe src="{{ $filmUrl }}" width="640" height="360"
                frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
</main>

@endsection
