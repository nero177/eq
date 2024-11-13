<footer>
    <div class="content wrapper">
        <svg class="icon">
            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#logo' }}"></use>
        </svg>
        <div class="container">
            <nav class="links">
                <a href="{{ localize_url('/#platform') }}">{{ __('site.platform') }}</a>
                <a href="{{ localize_url('/#program') }}">{{ __('site.courses') }}</a>
                <a href="{{ localize_url('/cabinet') }}">{{ __('site.cabinet') }}</a>
            </nav>
            <div class="social">
                <a href="mailto:{{ get_option('email') }}">{{ get_option('email') }}</a>
                <div class="social-icons">
                    <a href="{{ get_option('instagram') }}" target="_blank" rel="nofollow">
                        <svg class="icon inst">
                            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#inst' }}"></use>
                        </svg>
                    </a>
                    <a href="{{ get_option('facebook') }}" target="_blank" rel="nofollow">
                        <svg class="icon fb">
                            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#facebook' }}"></use>
                        </svg>
                    </a>
                    <a href="{{ get_option('youtube') }}" target="_blank" rel="nofollow">
                        <svg class="icon yt">
                            <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#youtube' }}"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="privacy-policy wrapper">
        <div class="desktop">
            <div class="info">
                <a href="#" class="colored">© 2024 Erteqoob – {{ __('site.all_rights') }}</a>
                @foreach ($pages as $page)
                    <a href="{{ localize_url('/'.$page->slug) }}">{{ $page->title }}</a>
                @endforeach
            </div>
            <div class="cards">
                <a href="#visa">
                    <svg class="icon visa">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#visa' }}"></use>
                    </svg>
                </a>
                <a href="#mastercard">
                    <svg class="icon mastercard">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#mastercard' }}"></use>
                    </svg>
                </a>
            </div>
        </div>
        <div class="mobile">
            <div class="top-links">
                <a href="{{ localize_url('/contract-offer') }}">{{ __('site.offer_agreement') }}</a>
                <a href="{{ localize_url('/privacy-policy') }}">{{ __('site.privacy_policy') }}</a>
            </div>
            <div class="bottom-links">
                <a href="#">© 2024 Erteqoob – {{ __('site.all_rights') }}</a>
                <a href="#visa">
                    <svg class="icon visa">
                        <use xlink:href="{{ asset('/assets/icons/sprite.svg') . '#visa-and-mastercard' }}"></use>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- jQuery -->
<script src="{{ asset('/assets/js/float-labels.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Owlcarousel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    AOS.init();
</script>
