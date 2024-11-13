@extends('layouts.front')
@section('content')
    <main class="about">
        <section class="banner" style="background-image: url('{{ retrieve_media_url_by_name('about-header-banner') }}')">
            <div class="content wrapper">
                <div class="info">
                    <h4 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        {!! get_option('about_banner_top_text') !!}
                    </h4>
                    <h2 data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="1300">
                        {!! get_option('about_banner_text') !!}
                    </h2>
                </div>
            </div>
        </section>

        <section class="leader">
            <div class="content wrapper">
                <div class="item">
                    <img src="{{ retrieve_media_url_by_name('about-page-leader-photo') }}" alt="leader"
                        data-aos="fade-right" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    <div class="content" data-aos="fade-left" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900">
                        <div class="name" bis_skin_checked="1">{{ get_option('about_author_name') }}</div>
                        <div class="second-name" bis_skin_checked="1">{{ get_option('about_author_surname') }}</div>
                        <div class="prof">{!! get_option('about_author_role') !!}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="creators">
            <div class="content wrapper">
                <div class="creators-title" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    {{ __('site.project_authors') }}
                </div>

                <x-creators-slider />
            </div>
        </section>

        <section class="academy" style="background-image: url('{{ asset('/assets/images/about/academy.jpg') }}')">
            <div class="content wrapper">
                <div class="academy-title" data-aos="fade-up" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    {{ __('site.academy') }}
                </div>
                <div class="locations">
                    <div class="item" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900">
                        <div class="title">{{ __('site.in_city') }}</div>
                        <div class="sub-title">{{ get_option('about_address_1') }}</div>
                    </div>
                </div>
            </div>
        </section>

        <section class="salons" style="background-image: url('{{ asset('/assets/images/about/salons.jpg') }}')">
            <div class="content wrapper">
                <div class="locations">
                    <div class="item" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                        data-aos-duration="900">
                        <div class="title">{{ __('site.kyiv') }}</div>
                        <div class="sub-title">{{ get_option('about_address_1') }}</div>
                    </div>
                    <div class="item" data-aos="fade-left" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                        <div class="title">{{ __('site.kyiv') }}</div>
                        <div class="sub-title">{{ get_option('about_address_2') }}</div>
                    </div>
                </div>
                <div class="salons-title" data-aos="fade-up" data-aos-anchor-placement="top-bottom" data-aos-duration="900">
                    {{ __('site.salons') }}
                </div>
            </div>
        </section>

        <section class="educators">
            <div class="content wrapper">
                <div class="educators-title" data-aos="fade-right" data-aos-anchor-placement="top-bottom"
                    data-aos-duration="900">
                    {{ __('site.teachers') }}
                </div>
                <img src="{{ retrieve_media_url_by_name('about-page-educators') }}" alt="educators" data-aos="fade-up"
                    data-aos-anchor-placement="top-bottom" data-aos-duration="900">
            </div>
        </section>

        <x-subscriptions-section />
    </main>
@endsection
