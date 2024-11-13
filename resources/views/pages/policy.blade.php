@extends('layouts.front')
@section('title')
    {{ $data['title'] }}
@endsection
@section('content')
    <main class="privacy-policy">
        <div class="content wrapper">
            {!! $data['content'] !!}
        </div>
    </main>
@endsection
