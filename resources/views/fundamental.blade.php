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
    <main class="fundamental-theory">
        <section class="banner">
            <div class="content wrapper">
                <div class="info">
                    <h2 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        {{ $collection->title }}
                    </h2>
                    <p data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1200">
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
                <img src="{{ asset('/assets/images/fundamental-theory/banner1.png') }}" class="banner-img"
                    alt="{{ $collection->title }}" />
            </div>
        </section>

        <section class="knowledge"
            style="background-image: url('{{ asset('/assets/images/fundamental-theory/knowledge.jpg') }}')">
            <div class="content wrapper">
                <div class="text">
                    {!! __('site.fundamental_headers') !!}
                </div>
            </div>
        </section>

        <section class="lessons">
            <div class="wrapper">
                {!! __('site.fundamental_text_section') !!}
            </div>
        </section>
        <section class="lessons-grid">
            <div class="grid-container">
                @foreach ($collection->lessons()->orderBy('order')->get() as $lesson)
                    <a href="{{ localize_url('/cabinet/lesson/' . $lesson->id) }}" class="item item-fundamental aos-init aos-animate" data-aos="fade-up"
                        data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                        @if ($lesson->hasMedia('thumbnail'))
                            <img src="{{ $lesson->getFirstMediaUrl('thumbnail') }}" alt="{{ $lesson->title }}" />
                        @endif
                        {{-- @include('components.buttons.favorite') --}}
                        <div class="title-count-wrap">
                            <div class="title">{{ $lesson->title }}</div>
                            <div class="count">{{ ($lesson->order < 10 ? '0' : '') . $lesson->order }}</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
        <x-subscriptions-section />
    </main>
@endsection
