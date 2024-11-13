@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle-wrap">
                <a href="#" class="cabinet-subtitle">
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#back-order' }}"></use>
                    </svg>

                    замовлення №{{ $order->order_number }}</a>
                <div class="order-info">
                    було переміщено у {{ $order->created_at->format('d.m.Y') }} і наразі {{ __($order->status) }}
                </div>
            </div>

            <table class="shopping-cart-table open-order">
                <thead>
                    <tr>
                        <th class="name">Товар</th>
                        <th class="quantity">Кількість</th>
                        <th class="sum">Сума загалом</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderables as $item)
                    <tr>
                        <td class="name">{{ $item->orderable->title }}</td>
                        <td class="quantity">{{ $item->count }}</td>
                        <td class="sum"><b>{{ format_price($item->count * $item->price) }} ₴ </b></td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>
                            Спосіб оплати: <b>&nbsp;Оплата карткою, Apple/Google Pay</b>
                        </th>
                        <th></th>
                        <th>Усього:<span class="value">&nbsp;{{ $order->amount }} ₴ </span></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </main>
@endsection
