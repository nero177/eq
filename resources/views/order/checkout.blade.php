@extends('layouts.front')
@section('fbq_events')
fbq('track', 'InitiateCheckout', { 
    content_ids: [{{ $productIds }}],
    content_type: 'product',
    value: {{ Cart::getSubtotal() }},
    currency: 'UAH',
    num_items: {{ count(Cart::getItems()) }}
});
@endsection
@section('content')
    <main class="order-placement">
        <div class="content wrapper">
            <div class="order-placement-title">{!! __('site.checkout') !!}</div>
            <a href="{{ localize_url('/cart') }}" class="link-back">
                <svg class="icon inst">
                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#arrow-back' }}"></use>
                </svg>
                {!! __('site.return_to_cart') !!}
            </a>
        
            <div class="order">
                <div class="order-title">{!! __('site.order') !!}</div>
                @foreach ($items as $item)
                    <div class="order-list-item">
                        <div class="item">
                            <div class="name">{!! __('site.name') !!}</div>
                            <div class="value">{{ $item->getTitle() }}</div>
                        </div>
                        <div class="item">
                            <div class="name">{!! __('site.price') !!}</div>
                            <div class="value">{{ format_price($item->getPrice()) }} ₴/рік</div>
                        </div>
                        <div class="item">
                            <div class="name">{!! __('site.amount') !!}</div>
                            <div class="value">{{ $item->getQuantity() }}</div>
                        </div>
                        <div class="item">
                            <div class="name">{!! __('site.total') !!}</div>
                            <div class="value"><b>{{ format_price($item->getPrice() * $item->getQuantity()) }} ₴</b></div>
                        </div>
                    </div>
                @endforeach
                <div class="total">
                    <div class="sub-title">
                        {!! __('site.total') !!}: <span>{{ format_price(Cart::getSubtotal()) }} ₴</span>
                    </div>
                </div>
            </div>
            <form action="{{ route('purchase') }}" target="_blank" method="post" class="placement-data fl-label-form"
                accept-charset="utf-8">
                @csrf
                <div class="title">{!! __('site.payment_data') !!}</div>

                <div class="form-group">
                    <label for="input-1">{!! __('site.edit_name') !!}</label>
                    <input type="text" id="input-1" required class="fl-label" name="name" />
                </div>
                <div class="form-group">
                    <label for="input-2">{!! __('site.surname') !!}*</label>
                    <input type="text" id="input-2" required class="fl-label" name="surname" />
                </div>
                <div class="form-group">
                    <label for="input-3">{!! __('site.phone') !!}*</label>
                    <input type="text" id="input-3" required class="fl-label" name="phone" />
                </div>
                <div class="form-group">
                    <label for="input-4">e-mail*</label>
                    <input type="text" id="input-4" required class="fl-label" name="email" />
                </div>
                <div class="form-error">
                    @error('email')
                        {{ $message }}
                    @enderror
                </div>

                <div class="payment-method">
                    <div class="title">{!! __('site.payment_methods') !!}</div>
                    <div class="cards">
                        {!! __('site.cart_payment') !!}, Apple/Google Pay
                        <img src="{{ asset('/assets/images/shop/visa.png') }}" alt="visa" />
                        <img src="{{ asset('/assets/images/shop/mastercard.png') }}" alt="mastercard" />
                    </div>
                    <div class="info">
                        {!! __('site.secure_cart_payment_dsec') !!}
                    </div>
                    <p>
                        {!! __('site.your_personal_data_message') !!}
                        <a href="{{ localize_url('/privacy-policy') }}">{{ __('site.privacy_policy') }}</a>.
                    </p>
                    <div class="form-group">
                        <div class="checkbox">
                            <input type="checkbox" id="supplier" name="supplier" value="yes" />
                            <label for="supplier">
                                <span>{!! __('site.i_read_rules') !!}
                                    <a href="{{ localize_url('/privacy-policy') }}"
                                        target="_blank">{{ __('site.privacy_policy') }}</a></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-error">
                        @error('supplier')
                            {{ $message }}
                        @enderror
                    </div>
                    <button type="submit" class="btn btn--primary w-100">{!! __('site.order_pay') !!}</a>
                </div>
            </form>

        </div>
    </main>
@endsection
