@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle">{!! __('site.new_forms') !!}</div>
            <div class="lessons">
                <div class="grid-container">
                    @foreach ($lessons as $lesson)
                        <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="800">
                            <div class="flex-container">
                                <div class="head">
                                    @if ($lesson->is_new)
                                        <h3>NEW</h3>
                                    @endif
                                    <div class="container">
                                        <div class="title">
                                            <div class="author">{{ __('site.author') }}:</div>
                                            <div class="name">
                                                <a
                                                    href="{{ localize_url('/author/' . $lesson->author->details['slug']) }}">{{ $lesson->author->name }}</a>
                                            </div>
                                        </div>

                                        <x-favorite-button :id="$lesson->id" :type="App\Enums\OrderableType::LESSON" />
                                    </div>
                                </div>
                                <p>{{ strip_tags(str_replace('<br>', ' ',  $lesson->title)) }}</p>
                                {{-- <a class="free-view-btn" href="{{ localize_url('/cabinet/lesson/' . $lesson->id) }}">
                                    @if ($lesson->is_free)
                                        {{ __('site.free_view') }}
                                    @else
                                        {{ __('site.show') }}
                                    @endif
                                </a> --}}
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
                                        fbq-id="{{ $subscription->id }}"
                                        fbq-type="{{ App\Enums\OrderableType::SUBSCRIPTION }}" fbq-name="{{ $subscription->title }}"
                                        fbq-category="Підписка"
                                        fbq-price="{{ $subscription->price_with_discount }}"
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
            </div>
        </div>
    </main>
@endsection
