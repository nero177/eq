@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />
            <div class="cabinet-subtitle">{!! __('site.welcome') !!}, {{$user->name}}!</div>
            @if (!$user->password_updated_at)
            <div class="cabinet-notification">
                {{ __('site.first_register_message') }}
                <a href="#" class="notice-close">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#close' }}"></use>
                    </svg>
                </a>
            </div>
            @endif
        </div>
    </main>
@endsection
