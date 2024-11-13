<div class="modal choice-course-modal" id="course">
    <div class="modal-content">
        <span class="close-icon"><svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="M1 1L21 21M21 1L1 21" stroke="" stroke-width="2" stroke-linecap="round" />
            </svg></span>

        <div class="content wrapper">
            <div class="title">{!! __('site.choose_your_program') !!}</div>
            <div class="owl-carousel choice-course-slide">
                @foreach ($collections as $collection)
                    <div class="tarif tarif2">
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
                        <h4>
                            @if (isset($collection->modal_details['modal_title_' . get_current_locale()]))
                                {{ $collection->modal_details['modal_title_' . get_current_locale()] }}
                            @else
                                {{ $collection->title }}
                            @endif
                        </h4>

                        @if ($collection->modal_text)
                            <div class="desc">
                                {!! $collection->modal_text !!}
                            </div>
                        @endif

                        {{-- @if (!is_purchased($collection->id, App\Enums\OrderableType::COLLECTION)) --}}
                        {{-- <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $collection->id }}">
                                <input type="hidden" name="price" value="{{ $collection->price_with_discount }}">
                                <input type="hidden" name="title" value="{{ $collection->title }}">
                                <input type="hidden" name="type" value="{{ App\Enums\OrderableType::COLLECTION }}"> --}}
                        {{-- <button type="submit"> --}}
                        <a href="{{ localize_url($collection->modal_details['button_url']) }}">
                            @if (isset($collection->modal_details['button_text_' . get_current_locale()]))
                                {{ $collection->modal_details['button_text_' . get_current_locale()] }}
                            @endif
                        </a>
                        {{-- </button> --}}
                        {{-- </form> --}}
                        {{-- @else
                            <a href="{{ localize_url('/cabinet/') }}">вільний
                                перегляд</a>
                        @endif --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
