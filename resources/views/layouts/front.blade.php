<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', config('app.name'))</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- owl carousel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- AOS animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />

    <!-- project styles -->
    {{-- @vite(['resources/sass/main.scss']) --}}
    @vite(['resources/sass/main.scss', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1677133583084836');
        fbq('track', 'PageView');
        @yield('fbq_events')
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=1677133583084836&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->

    <!-- Google Tag Manager -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-71YZM5DFW5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-71YZM5DFW5');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-71YZM5DFW5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- helpcrunch chat start-->
    <script type="text/javascript">
        window.helpcrunchSettings = {
            organization: 'erteqoob',
            appId: '708e04d7-bf89-439f-a2f0-28213b0849a3',
        };
    </script>

    <script type="text/javascript">
        (function(w, d) {
            var hS = w.helpcrunchSettings;
            if (!hS || !hS.organization) {
                return;
            }
            var widgetSrc = 'https://embed.helpcrunch.com/sdk.js';
            w.HelpCrunch = function() {
                w.HelpCrunch.q.push(arguments)
            };
            w.HelpCrunch.q = [];

            function r() {
                if (d.querySelector('script[src="' + widgetSrc + '"')) {
                    return;
                }
                var s = d.createElement('script');
                s.async = 1;
                s.type = 'text/javascript';
                s.src = widgetSrc;
                (d.body || d.head).appendChild(s);
            }
            if (d.readyState === 'complete' || hS.loadImmediately) {
                r();
            } else if (w.attachEvent) {
                w.attachEvent('onload', r)
            } else {
                w.addEventListener('load', r, false)
            }
        })(window, document)
    </script>
    <!-- helpcrunch chat end-->
</head>

<body>
    @include('components.header')
    @yield('content')

    <x-footer />
</body>

</html>
