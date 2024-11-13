@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle-wrap">
                <a href="{{ URL::previous() }}" class="cabinet-subtitle">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#back-order' }}"></use>
                    </svg>

                    {{ strip_tags($lesson->title) }}</a>
            </div>
            <div class="video-container">
                <iframe src="{{ $lesson->video_url }}" width="640" height="360" frameborder="0"
                    allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="authors">
                <div class="authors-wrap">
                    <div class="author-item">
                        <div class="author-thumb">
                            <img src="{{ $lesson->author->getFirstMediaUrl('avatar') }}" alt="author" />
                        </div>
                        <div class="author-content">
                            <div class="prof">{{ __('site.teacher') }}</div>
                            <div class="name">
                                {{ $lesson->author->localized_author_full_name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="adaptation-info">
                    <div class="info-item">
                        <div class="value">{{ $lesson->duration }}</div>
                        <div class="feature">
                            {!! __('site.lesson_duration_minutes') !!}
                        </div>
                    </div>
                    <div class="info-item text">
                        <div class="title">{{ __('site.subtitles') }}</div>
                        <div class="subtitle">{{ $lesson->captions }}</div>
                    </div>
                    <div class="info-item text">
                        <div class="title">{{ __('site.video_lang') }}</div>
                        <div class="subtitle">
                            {{ $lesson->video_locales_native }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="description">
                <div class="col-1">
                    @if ($lesson->desc)
                        <div class="title">{{ __('site.description') }}</div>
                        <p>{!! $lesson->desc !!}</p>
                    @endif

                    @if ($lesson->hasMedia('haircut_scheme') && $lesson->type != \App\Enums\LessonType::VIDEOCOURSE->value)
                        <a href="{{ $lesson->getFirstMediaUrl('haircut_scheme') }}" class="btn btn--primary"
                            target="_blank">{{ __('site.download_scheme') }}</a>
                    @endif

                    @if ($lesson->type == \App\Enums\LessonType::VIDEOCOURSE->value)
                        <a href="https://video.erteqoob-online.com/shema.pdf" class="btn btn--primary"
                            target="_blank">{{ __('site.manequen_scheme') }}</a>
                    @endif


                </div>
                <div class="col-2">
                    @if ($lesson->you_will_learn && $lesson->you_will_learn != '<br>')
                        <div class="title">{{ __('site.you_will_learn') }}</div>
                        <div class="lesson-text">
                            {!! $lesson->you_will_learn !!}
                        </div>
                    @endif
                    @if ($lesson->steps && $lesson->steps != '<br>')
                        <div class="title">{{ __('site.steps') }}</div>
                        <div class="lesson-text">
                            {!! $lesson->steps !!}
                        </div>
                    @endif
                </div>
            </div>
            @if ($lesson->diagram)
                <div class="video-container mt-60 mb-0">
                    <iframe loading="lazy" src="{{ $lesson->diagram }}" frameborder="0" width="100%" height="480"
                        data-rocket-lazyload="fitvidscompatible" data-lazy-src="{{ $lesson->diagram }}"
                        data-ll-status="loaded" class="entered lazyloaded"></iframe>
                </div>
            @endif

            @if ($lesson->video_bottom_url)
                <div class="video-container mt-60 mb-0">
                    <iframe src="{{ $lesson->video_bottom_url }}" width="640" height="360" frameborder="0"
                        allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                </div>
            @endif
        </div>
    </main>
@endsection
