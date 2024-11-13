@extends('layouts.front')
@section('content')
    <main class="blog">
        <section class="blog-section">
            <div class="content wrapper">
                <h1 class="blog-title" data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    {!! __('site.blog') !!}
                </h1>
                <div class="decorate-title" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="1100">
                    {!! __('site.popular_articles') !!}
                </div>
                <div class="popular-posts" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    <div class="col">
                        @if ($middleArticle)
                            <article class="post post-middle">
                                <a href="{{ localize_url('/article/' . $middleArticle->id) }}">
                                    <div class="thumb">
                                        @if ($middleArticle->getFirstMediaUrl('thumbnail'))
                                            <img src="{{ $middleArticle->getFirstMediaUrl('thumbnail') }}"
                                                alt="{{ $middleArticle->title }}" />
                                        @endif
                                    </div>
                                    <div class="title">{{ $middleArticle->title }}</div>
                                </a>
                            </article>
                        @endif
                        <div class="popular-posts">
                            @foreach ($popularArticles as $article)
                                <div class="col">
                                    <article class="post post-small">
                                        <a href="{{ localize_url('/article/' . $article->id) }}">
                                            <div class="thumb">
                                                @if ($article->getFirstMediaUrl('thumbnail'))
                                                    <img src="{{ $article->getFirstMediaUrl('thumbnail') }}"
                                                        alt="{{ $article->title }}" />
                                                @endif
                                            </div>
                                            <div class="title">{{ $article->title }}</div>
                                            <div class="text">
                                                {!! $article->short_desc !!}
                                            </div>
                                        </a>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col">
                        @if ($bigArticle)
                            <article class="post post-big">
                                <a href="{{ localize_url('/article/' . $bigArticle->id) }}">
                                    <div class="thumb">
                                        @if ($bigArticle->getFirstMediaUrl('thumbnail'))
                                            <img src="{{ $bigArticle->getFirstMediaUrl('thumbnail') }}"
                                                alt="{{ $bigArticle->title }}" />
                                        @endif
                                        <div class="content">
                                            <div class="title">{{ $bigArticle->title }}</div>
                                            <div class="btn btn--transparent">{{ __('site.read_article') }}</div>
                                        </div>
                                    </div>

                                    <div class="text">
                                        {!! $article->short_desc !!}
                                    </div>
                                </a>
                            </article>
                        @endif
                    </div>
                </div>
                <div class="decorate-title" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    {{ __('site.last') }}
                </div>
                <div class="grid-container" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    @for ($i = 0; $i < $showIndex; $i++)
                        @foreach ($lastArticles[$i] as $article)
                        <div class="grid-item w25">
                            <article class="post post-small">
                                <a href="{{ localize_url('/article/' . $article->id) }}">
                                    <div class="thumb">
                                        @if ($article->getFirstMediaUrl('thumbnail'))
                                            <img src="{{ $article->getFirstMediaUrl('thumbnail') }}"
                                                alt="{{ $article->title }}" />
                                        @endif
                                    </div>
                                    <div class="title">{{ $article->title }}</div>
                                    <div class="text">
                                        {!! $article->short_desc !!}
                                    </div>
                                </a>
                            </article>
                        </div>
                        @endforeach
                    @endfor
                </div>
                <div class="align-center">
                    <a href="?showIndex={{$showIndex + 1}}#show-more" class="btn btn--transparent btn--dark" id="show-more">{{ __('site.show_more') }}</a>
                </div>
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
