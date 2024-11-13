@extends('layouts.front')
@section('content')
    <x-modal-video />
    <main class="index">
        <x-banner-section show="main"/>
        <x-subscriptions-section />

        <section class="about-paltform wrapper" id="platform">
            <div class="content">
                <h2 class="text" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                    {!! __('site.about_platform') !!}
                </h2>
                <h2 class="text stroke" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    Erteqoob
                </h2>
                <p class="unic-platform" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="1000">
                    {!! $options['about_section_desc'] !!}
                </p>
                <p class="bold unic-platform" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="700">
                    {!! $options['about_section_subtext'] !!}
                </p>
                <div class="statistic unic-platform" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="700">
                    <div class="param param-1">
                        <h3>{{ $options['lessons_count'] }}</h3>
                        <p>{{ __('site.lessons_on_platform') }}</p>
                    </div>
                    <div class="param param-2">
                        <h3>{{ $options['lesson_duration_avg'] }}<span
                                class="time">{{ __('site.minutes_short') }}</span>
                        </h3>
                        <p>{{ __('site.avg_lesson_duration') }}</p>
                    </div>
                    <div class="param param-3">
                        <div class="lessons">
                            <h3>{{ $options['lessons_we_add'] }}</h3>
                            <h3>+</h3>
                        </div>
                        <p>{{ __('site.lessons_add_monthly') }}</p>
                    </div>
                    <div class="param param-4">
                        <h3>{{ $options['interesting_content_hours'] }}</h3>
                        <p>{{ __('site.interesting_content_hours') }}</p>
                    </div>
                </div>
                <div class="owners" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                    <div class="number">
                        <h3>{{ $options['users_amount'] }}</h3>
                        <div class="plus">+</div>
                    </div>
                    <p>{{ __('site.people_bought_subscription') }}</p>
                </div>
            </div>
            <div class="image-container" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-delay="300"
                data-aos-duration="700">
                <img src="{{ asset('/assets/images/index/about-platform.png') }}" alt="Про платформу Erteqoob" />
            </div>
        </section>
        <section class="about-paltform-subtext wrapper">
            <div></div>
            <div>
                <p>
                    {!! $options['about_section_purpose'] !!}
                </p>
            </div>
        </section>
        <section class="video-lessons" id="program">
            <div class="wrapper">
                <h2 class="heading">{{ __('site.videolessons') }}</h2>
            </div>
            <div class="videos">
                <div class="card">
                    <img src="{{ asset('/assets/images/index/viseo-lesson-1.png') }}"
                        alt="{{ __('site.master_classes') }}" />
                    <div class="content">
                        <h3>{{ __('site.master_classes') }}</h3>
                        <a href="{{ localize_url('/master-classes') }}">{{ __('site.more') }}</a>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ asset('/assets/images/index/viseo-lesson-2.png') }}"
                        alt="{{ __('site.videocourse') }}" />
                    <div class="content">
                        <h3>{{ __('site.videocourse') }}</h3>
                        <a href="{{ localize_url('/videocourse') }}">{{ __('site.more') }}</a>
                    </div>
                </div>
                <div class="card">
                    <img src="{{ asset('/assets/images/index/viseo-lesson-3.png') }}"
                        alt="{{ __('site.theory') }}" />
                    <div class="content">
                        <h3>{{ __('site.theory') }}</h3>
                        <a href="{{ localize_url('/theory') }}">{{ __('site.more') }}</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="team" id="team">
            <img src="{{ asset('/assets/images/index/team.png') }}" alt="команда" />
            <div class="bg"></div>
            <div class="bg2"></div>
            <div class="left-shadow"></div>
            <div class="right-shadow"></div>
            <div class="wrapper content">
                <h2 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                    {{ __('site.team') }}
                </h2>
                <button class="desktop modal-trigger" data-modal-id="main-video"
                    data-modal-video-url="{{ get_option('team_section_video') }}">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-110' }}"></use>
                    </svg>
                </button>
                <button class="mobile modal-trigger" data-modal-id="main-video"
                    data-modal-video-url="{{ get_option('team_section_video') }}">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-70' }}"></use>
                    </svg>
                </button>
                <div class="container">
                    <div class="title">
                        <h3 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                            {{ __('site.team_section_heading') }}
                        </h3>
                        <a href="{{ localize_url('/about') }}" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                            {{ __('site.team_section_more_button') }}
                        </a>
                    </div>
                    <div class="text">
                        <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700">
                            {!! __('site.team_section_description') !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="film">
            <img class="bg-img" src="{{ asset('assets/images/index/film.jpg') }}"
                alt="{{ __('site.film_section_head') }}" />
            <div class="left-shadow"></div>
            <div class="right-shadow"></div>
            <div class="mobile-shadow"></div>
            <div class="content wrapper">
                <div class="heading">
                    <h2 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"
                        data-aos-delay="700">
                        {!! __('site.film_section_head') !!}
                    </h2>
                    <p data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1200"
                        data-aos-delay="700">
                        {!! __('site.film_section_subhead') !!}
                    </p>
                </div>
                <div class="text-container">
                    <div class="left-block">
                        <h3>{!! __('site.film_left_head') !!}</h3>
                        <p>
                            {!! __('site.film_left_desc') !!}
                        </p>
                        <p class="colored">
                            {!! __('site.film_left_subdesc') !!}
                        </p>
                    </div>
                    <div class="right-block">
                        <h3>{!! __('site.film_right_head') !!}</h3>
                        <p>
                            {!! __('site.film_right_desc') !!}
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="big-video">
            <img src="assets/images/index/big-video.png" alt="" />
            <div class="left-shadow"></div>
            <div class="right-shadow"></div>
            <div class="container wrapper">
                <button class="play modal-trigger" data-modal-id="main-video"
                    data-modal-video-url="{{ get_option('home_page_bottom_video') }}">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-110' }}"></use>
                    </svg>
                    <svg class="mobile">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-70' }}"></use>
                    </svg>
                </button>
            </div>
        </section>
    </main>
@endsection
