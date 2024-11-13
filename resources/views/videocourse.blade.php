@extends('layouts.front')
@section('fbq_events')
fbq('track', 'ViewContent', { 
    content_type: '{{ $collection->type }}',
    content_ids: ['{{ $collection->id }}'],
    content_name: '{{ $collection->title }}',
    content_category: '{{ $collection->type }}',
    value: {{ $collection->price }},
    currency: 'UAH'
});
@endsection
@section('content')
    <x-modal-video />
    <main class="video-course">
        <section class="banner">
            <div class="content wrapper">
                <div class="info">
                    <h4>{{ __('site.videocourse') }}</h4>
                    <h2>{{ $collection->title }}</h2>
                    <p>
                        {{ $collection->desc }}
                    </p>
                    @if (!is_purchased($collection->id, App\Enums\OrderableType::COLLECTION))
                        <div class="offer">
                            <div class="price">
                                <span>
                                    <h3>{{ format_price($collection->price_with_discount) }}</h3>
                                    <p>₴</p>
                                </span>
                                @if ($collection->discount)
                                    <span class="old-price">{{ format_price($collection->price) }}
                                        <p>₴</p>
                                    </span>
                                @endif
                            </div>
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $collection->id }}">
                                <input type="hidden" name="price" value="{{ $collection->price_with_discount }}">
                                <input type="hidden" name="title" value="{{ $collection->title }}">
                                <input type="hidden" name="type" value="{{ App\Enums\OrderableType::COLLECTION }}">
                                <button type="submit" class="fbq-add-event"
                                fbq-id="{{ $collection->id }}"
                                fbq-type="{{ App\Enums\OrderableType::COLLECTION }}" fbq-name="{{ $collection->title }}"
                                fbq-category="Колекція"
                                fbq-price="{{ $collection->price_with_discount }}"
                                >{{ __('site.buy') }}</button>
                            </form>
                        </div>
                    @endif
                    <div style="margin-top: 20px">
                        <x-favorite-button :id="$collection->id" :type="App\Enums\OrderableType::COLLECTION" />
                    </div>
                </div>
                <img src="{{ asset('assets/images/video-course/banner-2.png') }}" class="banner-img" alt="" />
                <img src="{{ asset('assets/images/video-course/banner-1.png') }}" class="banner-img" alt="" />
                <img src="{{ asset('assets/images/video-course/banner-2.png') }}" class="banner-img" alt="" />
                <img src="{{ asset('assets/images/video-course/banner-1.png') }}" class="banner-img" alt="" />
                <img src="{{ asset('assets/images/video-course/banner-2.png') }}" class="banner-img" alt="" />
                <img src="{{ asset('assets/images/video-course/banner-1.png') }}" class="banner-img" alt="" />

                <a href="#stage" class="anchor-js">
                    <img src="assets/images/video-course/3d.png" class="visual-3d" alt="" />
                    <h4>3D {{ __('site.haircut_diagram') }}</h4>
                </a>
            </div>
        </section>
        <section class="statistics">
            <div class="wrapper container">
                <div class="element" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1000"
                    data-delay="100">
                    <h2>{{ $collection->lessons->count() }}</h2>
                    <h3>{{ __('site.videolessons_count') }}</h3>
                </div>
                <div class="element" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                    data-delay="200">
                    <h2>{{ get_option('lesson_duration') }}</h2>
                    <h3>
                        {!! __('site.minutes_lesson_dur') !!}
                    </h3>
                </div>
                <div class="element" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1200"
                    data-delay="300">
                    <h2>{{ get_option('course_duration') }}</h2>
                    <h3>
                        {!! __('site.interesting_content_hours') !!}
                    </h3>
                </div>
            </div>
        </section>
        <section class="information">
            <div class="container wrapper">
                <div class="element">
                    <h3>{!! __('site.about_course') !!}</h3>
                    <p>
                        {!! __('site.about_course_desc') !!}
                    </p>
                </div>
                <div class="element">
                    <h3>{!! __('site.courses_auditory') !!}</h3>
                    <p>
                        {!! __('site.courses_auditory_desc') !!}
                    </p>
                </div>
                <div class="element">
                    <h3>{!! __('site.what_we_teach') !!}</h3>
                    <ul>{!! __('site.what_we_teach_desc') !!}</ul>
                </div>
            </div>
        </section>
        <section class="marquee">
            <div class="marquee-container">
                <div class="item marquee-item">
                    <img src="assets/icons/list-white-icon.png" alt="" />
                    <h2>{!! __('site.course_program') !!}</h2>
                </div>
                <div class="item marquee-item">
                    <img src="assets/icons/list-white-icon.png" alt="" />
                    <h2>{!! __('site.course_program') !!}</h2>
                </div>
            </div>
        </section>
        <section class="course">
            <div class="container wrapper">
                @foreach ($collection->lessons()->orderBy('order')->get() as $lesson)
                    <div class="element">
                        <div class="info">
                            <div class="counter">
                                <h4>{{ $lesson->order }}</h4>
                                <h5>/{{ $collection->lessons->count() }}</h5>
                            </div>
                            <h3>{{ $lesson->title }}</h3>
                            <div class="btns">
                                @if (!is_purchased($collection->id, App\Enums\OrderableType::COLLECTION))
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $collection->id }}">
                                        <input type="hidden" name="price"
                                            value="{{ $collection->price_with_discount }}">
                                        <input type="hidden" name="title" value="{{ $collection->title }}">
                                        <input type="hidden" name="type"
                                            value="{{ App\Enums\OrderableType::COLLECTION }}">
                                        <button type="submit" class="buy fbq-add-event"
                                        fbq-id="{{ $collection->id }}"
                                        fbq-type="{{ App\Enums\OrderableType::COLLECTION }}" fbq-name="{{ $collection->title }}"
                                        fbq-category="Відеокурс"
                                        fbq-price="{{ $collection->price_with_discount }}"
                                        >{{ __('site.buy_course') }}</button>
                                    </form>
                                @else
                                    <a class="free-view-btn free-view-btn-videocourse"
                                        href="{{ localize_url('/cabinet/lesson/' . $lesson->id) }}">{{ __('site.show') }}</a>
                                @endif
                                <button class="demo modal-trigger" data-modal-id="main-video"
                                    data-modal-video-url="{{ $lesson->demo_url }}">demo</button>
                            </div>
                        </div>
                        @if ($lesson->hasMedia('thumbnail'))
                            <img src="{{ $lesson->getFirstMediaUrl('thumbnail') }}" alt="{{ $lesson->title }}" />
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
        <section class="stage-3d" id="stage">
            <div class="container wrapper">
                <div class="info">
                    <div class="heading">
                        <h2>3D</h2>
                        <div class="sub-heading">
                            {!! __('site.haircut_diagram_lg') !!}
                        </div>
                    </div>
                    <ul>
                        {!! __('site.program_desc') !!}
                    </ul>
                </div>
                <div class="video">
                    <video class="video_adaptive" preload="auto" autoplay loop muted webkit-playsinline playsinline
                        poster="">
                        <source src="https://video.erteqoob-online.com/1%205.mp4" type="video/mp4" />
                    </video>
                </div>
            </div>
        </section>
        <section class="teachers">
            <div class="container wrapper">
                <h2>{{ __('site.teachers') }}</h2>
                <div class="teachers-container">
                    @foreach ($teachers as $teacher)
                        <div class="teach">
                            <img src="{{ $teacher->getFirstMediaUrl('photo') }}" alt="{{ $teacher->name }}" />
                            <div class="name">
                                <h3>{{ $teacher->details['author_name_' . get_current_locale()] }}</h3>
                                <h3>{{ $teacher->details['author_surname_' . get_current_locale()] }}</h3>
                            </div>
                            <div class="position">
                                <p>{{ $teacher->details['author_role_' . get_current_locale()] }}</p>
                            </div>
                            <div class="list">
                                @if ($teacher->achievements)
                                    <ul>
                                        @foreach ($teacher->achievements as $achievement)
                                            @if (isset($achievement['col1_' . get_current_locale()]))
                                                <li data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                                    data-aos-duration="1100" data-aos-delay="200">
                                                    {{ $achievement['col1_' . get_current_locale()] }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                    <ul>
                                        @foreach ($teacher->achievements as $achievement)
                                            @if (isset($achievement['col2_' . get_current_locale()]))
                                                <li data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                                    data-aos-duration="1100" data-aos-delay="200">
                                                    {{ $achievement['col2_' . get_current_locale()] }}
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
