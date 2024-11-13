@extends('layouts.front')
@section('content')
    <main class="faqs">
        <section>
            <div class="content wrapper">
                <h1 class="faqs-title" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    {{ __('site.faq_head') }}
                </h1>

                <div class="accordion" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    @foreach ($faqs as $faq)
                        <div class="accordion__item">
                            <div class="accordion__title">
                                <span class="accordion__title-text">{{ $faq->question }}</span>
                                <span class="icons">
                                    <svg class="icon plus">
                                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#plus' }}"></use>
                                    </svg>
                                    <svg class="icon minus">
                                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#minus' }}"></use>
                                    </svg>
                                </span>
                            </div>
                            <div class="accordion__content">
                                <div class="text">{{ $faq->answer }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
