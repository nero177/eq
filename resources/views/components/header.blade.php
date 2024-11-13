<header class="header sticky sticky--top js-header">
    <div class="content wrapper">
        <a href="{{ localize_url('/') }}" class="logo">
            <svg class="icon">
                <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#logo' }}"></use>
            </svg>
        </a>
        <ul class="link-list">
            <li><a href="{{ localize_url('/#platform') }}">{{ __('site.platform') }}</a></li>
            <li><a href="{{ localize_url('/#team') }}">{{ __('site.team') }}</a></li>
            <li><a href="{{ localize_url('/#program') }}">{{ __('site.courses') }}</a></li>
            {{-- <li><a href="{{ localize_url('/blog') }}">{{ __('site.blog') }}</a></li> --}}
            <li><a href="{{ localize_url('/faq') }}">{{ __('site.faq') }}</a></li>
        </ul>
        <div class="controls">
            <a href="{{ localize_url('/cabinet') }}" class="user">
                <svg class="icon">
                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#user' }}"></use>
                </svg>
            </a>
            <a href="{{ localize_url('/cart') }}" class="shopping-basket">
                <svg class="icon">
                    <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#shopping-box' }}"></use>
                </svg>
                <div class="counter">{{ count(Cart::getItems()) }}</div>
            </a>
            <button class="menu" id="menuPopup">
                <div class="line line1"></div>
                <div class="line line2"></div>
            </button>

            <a class="cabinet" href="{{ localize_url('/cabinet') }}">{{ __('site.cabinet') }}</a>
            <div class="language-switcher select-menu">
                <div class="select-btn">
                    <span class="sBtn-text">{{ App::currentLocale() == 'uk' ? 'ua' : App::currentLocale()}}</span>
                    <svg class="icon">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#dropdown-more' }}"></use>
                    </svg>
                </div>

                <ul class="options">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class="option">
                            <a class="option-text" rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $localeCode == 'uk' ? 'ua' : $localeCode}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <div class="content">
            <div class="links">
                <a href="{{ localize_url('/#platform') }}">{{ __('site.platform') }}</a>
                <a href="{{ localize_url('/#team') }}">{{ __('site.team') }}</a>
                <a href="{{ localize_url('/#program') }}">{{ __('site.courses') }}</a>
                {{-- <a href="#">натхнення</a> --}}
                {{-- <a href="{{ localize_url('/blog') }}">{{ __('site.blog') }}</a> --}}
                <a href="{{ localize_url('/faq') }}">{{ __('site.faq') }}</a>
            </div>
            <div class="language">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a class="option-text" rel="alternate" hreflang="{{ $localeCode }}"
                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                        {{ $localeCode == 'uk' ? 'ua' : $localeCode}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</header>
