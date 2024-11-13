@extends('layouts.front')
@include('modals.product_added')
@section('content')
    <main class="author">
        <section class="author-banner wrapper">
            @if ($author->hasMedia('photo'))
                <img data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1200"
                    src="{{ $author->getFirstMediaUrl('photo') }}" alt="{{ $author->name }}" />
            @endif

            <div class="text">
                <h2 class="stroke" data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="1100">
                    {{ $author->details['author_name_' . get_current_locale()] ?? '' }}
                </h2>
                <h2 data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                    data-aos-delay="200" class="clamp">
                    {{ $author->details['author_surname_' . get_current_locale()] ?? '' }}
                </h2>
                <div class="director" data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                    data-aos-delay="300">
                    <h3> {{ $author->details['author_role_' . get_current_locale()] ?? '' }}</h3>
                </div>
                <div class="list">
                    @if ($author->achievements)
                        <ul>
                            @foreach ($author->achievements as $achievement)
                                @if (isset($achievement['col1_' . get_current_locale()]))
                                    <li data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                                        data-aos-delay="200">
                                        {{ $achievement['col1_' . get_current_locale()] }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                        <ul>
                            @foreach ($author->achievements as $achievement)
                                @if (isset($achievement['col2_' . get_current_locale()]))
                                    <li data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1100"
                                        data-aos-delay="200">
                                        {{ $achievement['col2_' . get_current_locale()] }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                </div>
            </div>
        </section>
        <section class="master-classes-records wrapper">
            <h2 data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="700" data-aos-delay="200">
                {!! __('site.master_class_records') !!}
            </h2>
        </section>
        <section class="lessons wrapper">
            <div class="grid-container">
                @foreach ($masterClasses as $lesson)
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
                                            <a href="{{ localize_url('/author/' . $author->details['slug']) }}">
                                                {{ $author->localized_author_full_name }}
                                            </a>
                                        </div>
                                    </div>

                                    <x-favorite-button :id="$lesson->id" :type="App\Enums\OrderableType::LESSON" />
                                </div>
                            </div>
                            <p>{{ $lesson->title }}</p>
                            @if (has_lesson_access($lesson->id, \App\Enums\LessonType::from($lesson->type)))
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
                                    <input type="hidden" name="price" value="{{ $lesson->discount }}">
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
        </section>
        <x-subscriptions-section />
    </main>
@endsection
