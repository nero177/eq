<section class="banner-carousel owl-carousel">
    @foreach ($banners as $banner)
        @if (!$banner->details['is_collection_banner'])
            <div class="slide slide-1">
                @if ($banner->hasMedia('bg'))
                    @if (in_array($banner->getFirstMedia('bg')->mime_type, ['image/png', 'image/jpeg', 'image/gif', 'image/webp']))
                        <img class="bg" src="{{ $banner->getFirstMediaUrl('bg') }}" alt="{{ $banner->title }}" />
                    @endif
                    @if (in_array($banner->getFirstMedia('bg')->mime_type, ['video/mp4']))
                        <video id="vid" muted autoplay loop class="bg"
                            src="{{ $banner->getFirstMediaUrl('bg') }}">Your browser does not support the video
                            tag.</video>
                    @endif
                @endif
                @if ($banner->hasMedia('bg_mob'))
                    @if (in_array($banner->getFirstMedia('bg_mob')->mime_type, ['image/png', 'image/jpeg', 'image/gif', 'image/webp']))
                        <img class="bg bg-mob" src="{{ $banner->getFirstMediaUrl('bg_mob') }}" alt="{{ $banner->title }}">
                    @endif
                    {{-- {{dd($banner->getFirstMedia('bg_mob'));}} --}}
                    @if (in_array($banner->getFirstMedia('bg_mob')->mime_type, ['video/mp4']))
                        <video id="vid_mob" muted autoplay loop class="bg bg-video-mob"
                            src="{{ $banner->getFirstMediaUrl('bg_mob') }}">Your browser does not support the video
                            tag.</video>
                    @endif
                @endif

                <div class="shadow">
                    <div class="content wrapper">
                        <h1>{!! $banner->title !!}</h1>
                        <p>
                            {!! $banner->desc !!}
                        </p>

                        @if (isset($banner->details['price']))
                            <div class="info">
                                <div class="offer">
                                    <div class="price">
                                        <span>
                                            @if ($banner->details['discount'])
                                                <h3>{{ format_price($banner->details['discount']) }}</h3>
                                                <p>₴</p>
                                            @else
                                                <h3>{{ format_price($banner->details['price']) }}</h3>
                                                <p>₴</p>
                                            @endif
                                        </span>

                                        @if ($banner->details['discount'])
                                            <span class="old-price">{{ format_price($banner->details['price']) }}
                                                <p>₴</p>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($banner->buttons && count($banner->buttons) >= 1)
                            @foreach ($banner->buttons as $button)
                                @if ($button['show'])
                                    @if ($button['type'] == 'video_popup')
                                        <button class="watch-presentation modal-trigger" data-modal-id="main-video"
                                            data-modal-video-url="{{ $button['video_url'] }}">
                                            <svg class="icon">
                                                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#watch' }}">
                                                </use>
                                            </svg>
                                            {{ $button['button_text_' . get_current_locale()] }}
                                        </button>
                                    @endif
                                    @if ($button['type'] == 'link')
                                        <a class="watch-presentation" href="{{ isset($button['link_' . get_current_locale()]) ? $button['link_' . get_current_locale()] : '#' }}"
                                            @if ($button['is_external']) target="_blank" @endif>
                                            {{ $button['button_text_' . get_current_locale()] }}
                                        </a>
                                    @endif
                                @endif
                            @endforeach
                        @endif
                        @if ($banner->video_link)
                            <button class="play-desktop play-btn modal-trigger" data-modal-id="main-video"
                                data-modal-video-url="{{ $banner->video_link }}">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-110' }}"></use>
                                </svg>
                            </button>
                            <button class="play-mobile play-btn modal-trigger" data-modal-id="main-video"
                                data-modal-video-url="{{ $banner->video_link }}">
                                <svg class="icon">
                                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-70' }}"></use>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="slide slide-1" @if (!$banner->hasMedia('bg')) style="background: #e0e0e0;" @endif>

                @if ($banner->getFirstMedia('bg'))
                    @if (
                        $banner->getFirstMedia('bg')->mime_type == 'image/png' ||
                            $banner->getFirstMedia('bg')->mime_type == 'image/jpeg' ||
                            $banner->getFirstMedia('bg')->mime_type == 'image/gif' ||
                            $banner->getFirstMedia('bg')->mime_type == 'image/webp')
                        <picture class="bg">
                            <source class="bg" media="(max-width: 764px)"
                                srcset="{{ $banner->getFirstMediaUrl('bg_mob') }}">
                            <img class="bg" src="{{ $banner->getFirstMediaUrl('bg') }}"
                                alt="{{ $banner->title }}" />
                        </picture>
                    @endif
                    @if ($banner->getFirstMedia('bg')->mime_type == 'video/mp4')
                        <video id="vid" muted autoplay loop class="bg"
                            src="{{ $banner->getFirstMediaUrl('bg') }}">Your browser does not support the video
                            tag.</video>
                        <video id="vid" muted autoplay loop class="bg bg-video-mob"
                            src="{{ $banner->getFirstMediaUrl('bg_mob') }}">Your browser does not support the video
                            tag.</video>
                    @endif
                @endif
                <div class="shadow">
                    <div class="content wrapper">
                        <h1> {!! $banner->title !!} </h1>

                        <p>
                            {!! $banner->desc !!}
                        </p>

                        <div class="info">
                            @if ($banner->buttons && count($banner->buttons) >= 1)
                                @foreach ($banner->buttons as $button)
                                    @if ($button['show'])
                                        @if ($button['type'] == 'video_popup')
                                            <button class="watch-presentation modal-trigger" data-modal-id="main-video"
                                                data-modal-video-url="{{ $button['video_url'] }}">
                                                <svg class="icon">
                                                    <use
                                                        xlink:href="{{ asset('/assets/icons/sprite.svg') . '#watch' }}">
                                                    </use>
                                                </svg>
                                                {{ $button['button_text_' . get_current_locale()] }}
                                            </button>
                                        @endif
                                        @if ($button['type'] == 'link')
                                            <a class="watch-presentation" href="{{ $button['link'] }}"
                                                @if ($button['is_external']) target="_blank" @endif>
                                                {{ $button['button_text_' . get_current_locale()] }}
                                            </a>
                                        @endif
                                        @if ($button['type'] == 'collection' && !is_purchased($banner->collection->id, App\Enums\OrderableType::COLLECTION))
                                        <div class="offer">
                                                <div class="price">
                                                    <span>
                                                        <h3>{{ format_price($banner->collection->price_with_discount) }}
                                                        </h3>
                                                        <p>₴</p>
                                                    </span>
                                                    @if ($banner->collection->discount)
                                                        <span
                                                            class="old-price">{{ format_price($banner->collection->price) }}
                                                            <p>₴</p>
                                                        </span>
                                                    @endif
                                                </div>
                                                <form action="{{ route('cart.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id"
                                                        value="{{ $banner->collection->id }}">
                                                    <input type="hidden" name="price"
                                                        value="{{ $banner->collection->price_with_discount }}">
                                                    <input type="hidden" name="title"
                                                        value="{{ $banner->collection->title }}">
                                                    <input type="hidden" name="type"
                                                        value="{{ App\Enums\OrderableType::COLLECTION }}">
                                                    <button type="submit" class="fbq-add-event"
                                                    fbq-id="{{ $banner->collection->id }}"
                                                    fbq-type="{{ App\Enums\OrderableType::COLLECTION }}" fbq-name="{{ $banner->collection->title }}"
                                                    fbq-category="Колекція"
                                                    fbq-price="{{ $banner->collection->price_with_discount }}"
                                                    >{{ $button['button_text_' . get_current_locale()] }}</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            @endif

                            @if ($banner->video_link)
                                <button class="play-desktop play-btn modal-trigger" data-modal-id="main-video"
                                    data-modal-video-url="{{ $banner->video_link }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-110' }}"></use>
                                    </svg>
                                </button>
                                <button class="play-mobile play-btn modal-trigger" data-modal-id="main-video"
                                    data-modal-video-url="{{ $banner->video_link }}">
                                    <svg class="icon">
                                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#play-70' }}"></use>
                                    </svg>
                                </button>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        @endif
    @endforeach
</section>
