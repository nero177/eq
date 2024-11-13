<section class="start">
    <div class="content wrapper">
        <div class="text-section">
            {!! __('site.start_to_improve_your_skills') !!}
            <p data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
                {{ $options['start_section_desc'][$lang] ?? $options['start_section_desc']['uk'] }}
            </p>
        </div>
        <div class="tarifs" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1000">
            <div class="tarif tarif1">
                <h3>{!! __('site.choose_your_program') !!}</h3>
                <button class="modal-trigger" data-modal-id="course">
                    {{ __('site.choose_course') }}
                </button>
            </div>
            <div class="tarif tarif2">
                <div class="price">
                    <span>
                        <h3>{{ format_price($subscription->price_with_discount) }}</h3>
                        <p>₴</p>
                    </span>
                    @if ($subscription->discount)
                        <span class="old-price">{{ format_price($subscription->price) }}
                            <p>₴</p>
                        </span>
                    @endif
                </div>
                <h4>{{ $subscription->title }}</h4>
                <ul>
                    @foreach ($subscription->access as $access)
                        @if ($access->type == 'master_class')
                            <li>{{ __('site.master_classes') }}</li>
                        @else
                            <li>{{ __('site.' . $access->type) }}</li>
                        @endif
                    @endforeach
                </ul>

                @if (!is_purchased($subscription->id, App\Enums\OrderableType::SUBSCRIPTION))
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{ $subscription->id }}">
                        <input type="hidden" name="price" value="{{ $subscription->price_with_discount }}">
                        <input type="hidden" name="title" value="{{ $subscription->title }}">
                        <input type="hidden" name="type" value="{{ App\Enums\OrderableType::SUBSCRIPTION }}">
                        <button type="submit" class="fbq-add-event" 
                            fbq-id="{{ $subscription->id }}"
                            fbq-type="{{ App\Enums\OrderableType::SUBSCRIPTION }}" 
                            fbq-name="{{ $subscription->title }}"
                            fbq-category="Підписка"
                            fbq-price="{{ $subscription->price_with_discount }}"
                        >{{ __('site.buy_for_year') }}</button>
                    </form>
                @else
                    <a href="{{ localize_url('/cabinet/') }}">{{ __('site.show') }}</a>
                @endif
            </div>
        </div>
    </div>
</section>
<x-choise-course-modal />
