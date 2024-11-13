@extends('layouts.front')
@section('content')
<main class="cabinet">
    <div class="content wrapper">
        <div class="cabinet-title">{{ __('site.cabinet') }}</div>
        <div class="cabinet-wrap tabs js-tabs-simple">

            <form action="" method="post" class="cabinet-form fl-label-form">
                <div class="title">{{ __('site.recovery_mail_sended') }}</div>
                <div class="text">
                    {{ __('site.recovery_mail_sended_msg') }}
                </div>
                <div class="sub-title">
                    {{ __('site.please_wait') }}
                </div>

                <a href="{{ localize_url('/cabinet/auth') }}" class="remember-password">
                    <svg class="icon" width="11" height="10" viewBox="0 0 11 10" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M11 5H2M2 5L6 1M2 5L6 9" stroke="#E21414" stroke-width="1.6" />
                    </svg>
                    {{ __('site.return_to_login') }}
                </a>
            </form>
        </div>
    </div>
</main>
@endsection
