@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <div class="cabinet-title">{{ __('site.cabinet') }}</div>
            <div class="cabinet-wrap tabs js-tabs-simple">
                <form action="{{ route('forgot-password') }}" method="post" class="cabinet-form fl-label-form">
                    @csrf
                    <div class="title">{{ __('site.lost_password_question') }}</div>
                    <div class="text">
                        {{ __('site.forgot_password_message') }}
                    </div>
                    <div class="form-group">
                        <label for="input-1">{{ __('site.email_address') }} *</label>
                        <input type="text" id="input-1" required class="fl-label" name="email" />
                    </div>
                    <div class="form-error">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                    <button class="btn btn--primary w-100">{{ __('site.login') }}</button>

                    <a href="{{ localize_url('/cabinet/auth') }}" class="remember-password">
                        <svg class="icon" width="11" height="10" viewBox="0 0 11 10" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M11 5H2M2 5L6 1M2 5L6 9" stroke="#E21414" stroke-width="1.6" />
                        </svg>
                        {{ __('site.i_remembered_password') }}
                    </a>
                </form>
            </div>
        </div>
    </main>
@endsection
