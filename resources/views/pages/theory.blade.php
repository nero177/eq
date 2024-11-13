@extends('layouts.front')
@section('content')
    <main class="theory">
        <section class="theory-section theory-slider owl-carousel">
            @foreach ($theoryItems as $item)
                <div class="theory-item">
                    <img src="{{ $item->getFirstMediaUrl('bg') }}" alt="базова термінологія та механіка" />
                    <div class="content">
                        <div class="title" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                            data-aos-duration="900">
                            {{ $item->name }}
                        </div>
                        <a href="{{ localize_url($item->url) }}" class="btn btn--transparent" data-aos="fade-up"
                            data-aos-anchor-placement="top-bottom" data-aos-duration="900">детальніше</a>
                    </div>
                </div>
            @endforeach
        </section>

        <x-subscriptions-section />
    </main>
@endsection
