@extends('layouts.front')
@section('content')
    <main class="shopping-cart">
        <div class="content wrapper">
            <div class="wrap">
                <div class="shopping-cart-title">{{ __('site.cart') }}</div>
                <form action="{{ route('cart.remove-all') }}" method="POST">
                    @csrf
                    <button type="submit" class="clear-cart">
                        <svg class="icon">
                            <use xlink:href="./assets/icons/sprite.svg#shop-cart"></use>
                        </svg>
                        {{ __('site.delete_all') }}
                    </button>
                </form>
            </div>
            <table class="shopping-cart-table">
                <thead>
                    <tr>
                        <th class="name">{{ __('site.name') }}</th>
                        <th class="cost">{{ __('site.price') }}</th>
                        <th class="quantity">{{ __('site.count') }}</th>
                        <th class="sum">{{ __('site.amount') }}</th>
                        <th class="delete"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="name">{{ strip_tags(str_replace('<br>', ' ', $item->getTitle())) }}</td>
                            <td class="cost">
                                {{ format_price($item->getPrice()) }} ₴
                                @if ($item->getExtraInfo()['type'] == 'subscription')
                                    /{{ __('site.year') }}
                                @endif
                            </td>
                            <td class="quantity">
                                <div class="qty-input">
                                    @if ($item->getExtraInfo()['type'] == 'subscription')
                                        <form action="{{ route('cart.update-quantity') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="hash" value="{{ $item->getHash() }}">
                                            <input type="hidden" name="quantity" value="{{ $item->getQuantity() - 1 }}">
                                            <button class="qty-count qty-count--minus" data-action="minus" type="submit">
                                                <svg class="icon" id="arrow-left" width="6" height="10"
                                                    viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5 9L1 5L5 1" stroke="currentColor" stroke-width="1.6"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    @if ($item->getExtraInfo()['type'] == 'subscription')
                                    <input class="product-qty" type="number" name="product-qty" min="1"
                                        max="10" value="{{ $item->getQuantity() }}" />
                                    @else
                                    <input class="product-qty" type="number" name="product-qty" min="1"
                                        max="10" value="1" @disabled(true) />
                                    @endif

                                    @if ($item->getExtraInfo()['type'] == 'subscription')
                                        <form action="{{ route('cart.update-quantity') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="hash" value="{{ $item->getHash() }}">
                                            <input type="hidden" name="quantity" value="{{ $item->getQuantity() + 1 }}">
                                            <button class="qty-count qty-count--add" data-action="add" type="submit">
                                                <svg class="icon" id="arrow-right" width="6" height="10"
                                                    viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M1 9L5 5L1 1" stroke="currentColor" stroke-width="1.6"
                                                        stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            <td class="sum"><b>{{ $item->getPrice() * $item->getQuantity() }} ₴</b></td>
                            <td class="delete">
                                <form action="{{ route('cart.remove') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="hash" value="{{ $item->getHash() }}">

                                    <button type="submit" class="remove">
                                        <svg class="icon">
                                            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#remove' }}"></use>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total">
                <div class="title">{{ __('site.total') }}:</div>
                <div class="value">{{ Cart::getSubtotal() }} ₴</div>
                <a href="{{ localize_url('/payment/checkout') }}" class="btn btn--primary">{{ __('site.to_order') }}</a>
            </div>
        </div>
    </main>
@endsection
