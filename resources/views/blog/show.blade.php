@extends('layouts.front')
@section('content')
    <main class="blog-single">
        <section class="blog-section">
            <article class="post post-single">
                <div class="thumb" style="background-image: url('{{ $article->getFirstMediaUrl('thumbnail') }}')">
                    <div class="title" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        {{ $article->title }}
                    </div>
                </div>
                <div class="post-content" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="1300">
                    {!! $article->content !!}
                </div>
            </article>
            <div class="content wrapper">
                <div class="decorate-title">{{ __('site.can_be_interesting') }}</div>
                <div class="grid-container">
                    @foreach ($article->related as $related)
                        <div class="grid-item w25">
                            <article class="post post-small">
                                <a href="{{ localize_url('/article/' . $related->id) }}">
                                    <div class="thumb">
                                        @if ($article->getFirstMediaUrl('thumbnail'))
                                            <img src="{{ $article->getFirstMediaUrl('thumbnail') }}"
                                                alt="{{ $article->title }}" />
                                        @endif
                                    </div>
                                    <a href="#" class="title">{{ $related->title }}</a>
                                    <div class="text">
                                        {{ $related->short_desc }}
                                    </div>
                                </a>
                            </article>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
