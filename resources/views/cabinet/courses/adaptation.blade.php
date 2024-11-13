@extends('layouts.front')
@section('content')
<main class="cabinet">
    <div class="content wrapper">
        <x-cabinet-navigation />

        <div class="cabinet-subtitle">{!! __('site.adaptation') !!}</div>

        <div class="adaptation-single" style="background-image: url('{{ $lesson->getFirstMediaUrl('thumbnail') }}')">
            {{-- @include('components.buttons.favorite') --}}
            <div class="content">
                <div class="title">{!! $lesson->title !!}</div>

                @if (has_lesson_access($lesson->id, App\Enums\LessonType::ADAPTATION))
                    <a href="{{ localize_url('/cabinet/lesson/'.$lesson->id) }}" class="btn btn--transparent brn--dark">{{ __('site.show') }}</a>
                @else
                    <a href="{{ localize_url('/adaptation') }}" class="btn btn--transparent brn--dark">{{ __('site.buy') }}</a>
                @endif
            </div>
        </div>
    </div>
</main>
@endsection