@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle">
                @if (isset($collection->title))
                    {{ strip_tags(str_replace('<br>', ' ', $collection->title )) }}
                @else
                    {{ __('site.master_classes') }}
                @endif
            </div>
            <div class="lessons">
                <div class="grid-container">
                    @if ($lessons && $lessons->count() > 0)
                        @foreach ($lessons as $lesson)
                            <div class="item" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                                data-aos-duration="800">
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
                                                        href="{{ localize_url('/author/' . $lesson->author->details['slug']) }}">
                                                        {{ $lesson->author->localized_author_full_name }}
                                                    </a>
                                                </div>
                                            </div>

                                            <x-favorite-button :id="$lesson->id" :type="App\Enums\OrderableType::LESSON" />
                                        </div>
                                    </div>
                                    <p>{{ $lesson->title }}</p>
                                    <a class="free-view-btn" href="{{ localize_url('/cabinet/lesson/' . $lesson->id) }}">
                                        @if ($lesson->is_free)
                                            {{ __('site.free_view') }}
                                        @else
                                            {{ __('site.show') }}
                                        @endif
                                    </a>
                                </div>
                                @if ($lesson->hasMedia('thumbnail'))
                                    <img src="{{ $lesson->getFirstMediaUrl('thumbnail') }}" alt="{{ $lesson->title }}" />
                                @endif
                            </div>
                        @endforeach
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
                            {{ __('site.nothing_purchased') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
