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
    @include('modals.product_added')

    <main class="master-classes">
        <x-banner-section show="master_classes" />

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
                            <p>{{ strip_tags(str_replace('<br>', ' ',  $lesson->title)) }}</p>
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
                                        fbq-type="{{ App\Enums\OrderableType::LESSON }}" 
                                        fbq-name="{{ $lesson->title }}"
                                        fbq-category="Майстер класи"
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
