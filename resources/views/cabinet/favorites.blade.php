@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle-favorite">
                <div class="cabinet-subtitle">{!! __('site.choosed') !!}</div>
                @if ($favorites->count() > 0)
                    <form action="{{ route('favorites.remove-all') }}" method="POST">
                        @csrf
                        <button type="submit" class="remove-all">
                            <svg class="icon">
                                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#shop-cart' }}"></use>
                            </svg>

                            видалити все
                        </button>
                    </form>
                @endif
            </div>
        </div>
        @if ($favorites->count() > 0)
            <div class="lessons lessons-grid favorites content wrapper">
                <div class="grid-container">
                    @foreach ($favorites as $item)
                        @if (
                            $item->item_type == App\Enums\OrderableType::COLLECTION->model() ||
                                (isset($item->favoritable->type) && $item->favoritable->type == App\Enums\LessonType::ADAPTATION->value))
                            <div class="item item--dark" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-duration="800">
                                <div class="flex-container">
                                    <div class="head">
                                        <div class="container">
                                            <div class="title">
                                                <div class="author">{{ __('site.videocourse') }}</div>
                                                <div class="name">
                                                    <a href="#">{!! $item->favoritable->title !!}</a>
                                                </div>
                                            </div>

                                            <x-favorite-button :id="$item->favoritable->id" :type="App\Enums\OrderableType::COLLECTION" />
                                        </div>
                                    </div>

                                    @if (isset($item->favoritable->type) && $item->favoritable->type == App\Enums\LessonType::ADAPTATION->value)
                                        <a class="free-view-btn"
                                            href="{{ localize_url('/cabinet/lesson/' . $item->favoritable->id) }}">{{ __('site.show') }}</a>
                                    @else
                                        <a href="{{ localize_url('/cabinet/' . $item->favoritable->slug) }}"
                                            class="free-view-btn">{{ __('site.show') }}</a>
                                    @endif
                                </div>
                                <img src="{{ $item->favoritable->getFirstMediaUrl('thumbnail') }}" alt="lesson" />
                            </div>
                        @else
                            <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-duration="800">
                                <div class="flex-container">
                                    <div class="head">
                                        @if ($item->favoritable->is_new)
                                            <h3>NEW</h3>
                                        @endif
                                        <div class="container">
                                            <div class="title">
                                                <div class="author">{{ __('site.author') }}:</div>
                                                <div class="name">
                                                    <a
                                                        href="{{ localize_url('/author/' . $item->favoritable->author->details['slug']) }}">
                                                        {{ $item->favoritable->author->localized_author_full_name }}
                                                    </a>
                                                </div>
                                            </div>

                                            <x-favorite-button :id="$item->favoritable->id" :type="App\Enums\OrderableType::LESSON" />
                                        </div>
                                    </div>
                                    <p>{!! $item->favoritable->title !!}</p>
                                    <a class="free-view-btn"
                                        href="{{ localize_url('/cabinet/lesson/' . $item->favoritable->id) }}">
                                        @if ($item->favoritable->is_free)
                                            {{ __('site.free_view') }}
                                        @else
                                            {{ __('site.show') }}
                                        @endif
                                    </a>
                                </div>
                                @if ($item->favoritable->hasMedia('thumbnail'))
                                    <img src="{{ $item->favoritable->getFirstMediaUrl('thumbnail') }}"
                                        alt="{{ $item->favoritable->title }}" />
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <div class="lessons favorite-empty content wrapper">
                <div class="grid-container">
                    <div class="favorite-empty-item"></div>
                    <div class="favorite-empty-item"></div>
                    <div class="favorite-empty-item"></div>
                </div>
            </div>
            <div class="favorite-empty-info">
                <svg class="icon">
                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#favorite' }}"></use>
                </svg>
                {{ __('site.no_favorites_added') }}
            </div>
        @endif
    </main>
@endsection
