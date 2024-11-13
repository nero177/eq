@extends('layouts.front')
@section('fbq_events')
fbq('track', 'Purchase', { 
    value: {{ request('value') }},
    content_ids: {{ implode(',', request('content_ids')) }},
    content_type: '{{ request('content_type') }}',
    num_items: {{ request('num_items') }},
    currency: 'UAH'
});
@endsection
@section('content')
    @php
        $order = App\Models\Order::find(request('order'));
    @endphp
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'purchase',
            'transactionId': '{{ $order->id }}',
            'transactionTotal': {{ $order->total_price }},
            'utm_source': '{{ $order->utm_source }}',
            'utm_medium': '{{ $order->utm_medium }}',
            'utm_campaign': '{{ $order->utm_campaign }}',
            'utm_term': '{{ $order->utm_term }}',
            'utm_content': '{{ $order->utm_content }}'
        });
    </script>
    <main class="cabinet">
        <div class="content wrapper">
            <div class="cabinet-wrap tabs js-tabs-simple">
                <form action="" method="post" class="cabinet-form fl-label-form">
                    <div class="title">{{ __('site.thanks_for_purchase') }}</div>
                    {{-- <div class="text">
                        {{ __('site.thanks_for_purchase_text') }}
                    </div> --}}

                    <a href="{{ localize_url('/cabinet') }}" class="remember-password">
                        <svg class="icon" width="11" height="10" viewBox="0 0 11 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 5H2M2 5L6 1M2 5L6 9" stroke="#E21414" stroke-width="1.6" />
                        </svg>
                        {{ __('site.return_to_cab') }}
                    </a>
                </form>
            </div>
        </div>
    </main>
@endsection
