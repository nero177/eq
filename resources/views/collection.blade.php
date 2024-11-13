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
@include('modals.product_added')
@section('content')
    <main class="collection">
        {{-- style="background-image: url('{{ $collection->getFirstMediaUrl('banner') }}'); background-size: cover;" --}}
        <section class="banner">
            {{-- <img src="" class="banner-img"
                        alt="{{ $collection->title }}" data-aos="zoom-in" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900" /> --}}
            @if ($collection->getFirstMedia('banner'))
                @if (
                    $collection->getFirstMedia('banner')->mime_type == 'image/png' ||
                        $collection->getFirstMedia('banner')->mime_type == 'image/jpeg' ||
                        $collection->getFirstMedia('banner')->mime_type == 'image/gif' ||
                        $collection->getFirstMedia('banner')->mime_type == 'image/webp')
                    <picture class="bg">
                        <source class="bg" media="(max-width: 764px)" srcset="{{ $collection->getFirstMediaUrl('banner_mob') }}">
                        <img class="bg" src="{{ $collection->getFirstMediaUrl('banner') }}" alt="{{ $collection->title }}" />
                    </picture>
                @endif
                @if ($collection->getFirstMedia('banner')->mime_type == 'video/mp4')
                    <video id="vid" muted autoplay loop class="bg"
                        src="{{ $collection->getFirstMediaUrl('banner') }}">Your browser does not support the video
                        tag.</video>
                    <video id="vid" muted autoplay loop class="bg bg-video-mob"
                        src="{{ $collection->getFirstMediaUrl('banner_mob') }}">Your browser does not support the video
                        tag.</video>
                @endif
            @endif

            <div class="content wrapper">
                <div class="info">
                    <h2 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        {!! $collection->title !!}
                    </h2>
                    @if (isset(json_decode($collection->getRawOriginal('desc'), true)[get_current_locale()]))
                        <p data-aos="fade-righy" data-aos-anchor-placement="top-bottom" data-aos-duration="1300">
                            {!! $collection->desc !!}
                        </p>
                    @endif
                    @if (
                        !\App\Services\AccessService::userHasAllCollectionLessons($collection->id) &&
                            !\App\Services\AccessService::isPurchased($collection->id, \App\Enums\OrderableType::COLLECTION))
                        <div class="offer" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="1300">
                            <div class="price">
                                <span>
                                    <h3>{{ format_price($collection->price_with_discount) }}
                                    </h3>
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
                                <button type="submit" class="buy-btn fbq-add-event"
                                fbq-id="{{ $collection->id }}"
                                fbq-type="{{ App\Enums\OrderableType::COLLECTION }}" fbq-name="{{ $collection->title }}"
                                fbq-category="Колекція"
                                fbq-price="{{ $collection->price_with_discount }}"
                                >{{ __('site.buy') }}</button>
                            </form>
                        </div>
                    @endif
                </div>
                @if (!$collection->hasMedia('banner'))
                    <img src="{{ asset('/assets/images/collection/banner.png') }}" class="banner-img"
                        alt="{{ $collection->title }}" data-aos="zoom-in" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900" />
                @endif
            </div>
        </section>

        <section class="recordings">
            <div class="container wrapper">
                <div class="title" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1100">
                    <h2>{{ $collection->lessons->count() }}</h2>
                    <div class="subtitle">
                        <h3>
                            {!! __('site.master_class_recordings') !!}
                        </h3>
                        <p>{!! __('site.twelve_month_access') !!}</p>
                    </div>
                </div>
                <div class="text-block" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1100">
                    <p>
                        {{ $collection->details }}
                    </p>
                </div>
            </div>
        </section>

        <section class="lessons wrapper">
            <div class="grid-container">
                @foreach ($collection->lessons as $lesson)
                    <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        <div class="flex-container">
                            <div class="head">
                                @if ($lesson->is_new)
                                    <h3>NEW</h3>
                                @endif
                                <div class="container">
                                    <div class="title">
                                        <div class="author">{{ __('site.author') }}:</div>
                                        <a class="name"
                                            href="{{ localize_url('/author/' . $lesson->author->details['slug']) }}">
                                            {{ $lesson->author->localized_author_full_name }}
                                        </a>
                                    </div>
                                    <x-favorite-button :id="$lesson->id" :type="App\Enums\OrderableType::LESSON" />
                                </div>
                            </div>
                            <p>{{ $lesson->title }}</p>
                            @if (has_lesson_access($lesson->id, \App\Enums\LessonType::MASTER_CLASS))
                                <a class="free-view-btn" href="{{ localize_url('/cabinet/lesson/' . $lesson->id) }}">
                                    @if ($lesson->is_free)
                                        {{ __('site.free_view') }}
                                    @else
                                        {{ __('site.show') }}
                                    @endif
                                </a>
                            @else
                                <form action="{{ route('cart.store') }}" method="POST" class="add-master-class">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $lesson->id }}">
                                    <input type="hidden" name="price" value="{{ $lesson->price_with_discount }}">
                                    <input type="hidden" name="title" value="{{ $lesson->title }}">
                                    <input type="hidden" name="type" value="{{ App\Enums\OrderableType::LESSON }}">
                                    <button type="submit" class="buy-btn fbq-add-event"
                                    fbq-id="{{ $lesson->id }}"
                                    fbq-type="{{ App\Enums\OrderableType::LESSON }}" fbq-name="{{ $lesson->title }}"
                                    fbq-category="Майстер клас"
                                    fbq-price="{{ $lesson->price_with_discount }}"
                                    >{{ __('site.buy_lesson') }}</button>
                                </form>
                            @endif
                        </div>
                        @if ($lesson->hasMedia('thumbnail'))
                            <img src="{{ $lesson->getFirstMediaUrl('thumbnail') }}" alt="{{ $lesson->title }}" />
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
