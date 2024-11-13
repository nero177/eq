@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle">{{ __('site.last_orders') }}</div>
            <table class="shopping-cart-table cart-table-last-orders">
                <thead>
                    <tr>
                        <th class="number">{{ __('site.order_number') }}</th>
                        <th class="date">{{ __('site.date') }}</th>
                        <th class="status">{{ __('site.status') }}</th>
                        <th class="sum">{{ __('site.amount') }}</th>
                        <th class="actions align-center">{{ __('site.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td class="number">
                            <div class="mobile-only">{{ __('site.order_number') }}</div>
                            {{ $order->order_number }}
                        </td>
                        <td class="date">
                            <div class="mobile-only">{{ __('site.date') }}</div>
                            {{ $order->created_at->format('Y.m.d') }}
                        </td>
                        <td class="quantity">
                            <div class="mobile-only">{{ __('site.status') }}</div>
                            {{ __($order->status) }}
                        </td>
                        <td class="sum"><b>{{ $order->amount }} ₴ </b>за {{ count($order->orderables) }} {{count($order->orderables) > 1 ? 'позиції' : 'позицію'}}</td>
                        <td class="actions align-center">
                            <a href="{{ localize_url('/cabinet/order/' . $order->order_number) }}" class="btn btn--transparent btn--dark">
                                {{ __('site.show') }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection
