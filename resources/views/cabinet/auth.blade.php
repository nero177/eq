@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <div class="cabinet-title">{{ __('site.cabinet') }}</div>
            <div class="cabinet-wrap tabs js-tabs-simple">
                <div class="list tabs-wrapper">
                    <div class="item tab active">{{ __('site.login') }}</div>
                    <div class="item tab">{{ __('site.register') }}</div>
                </div>

                <div class="tabs-content-wrapper">
                    <div class="tabContent">
                        <form action="{{ route('login') }}" method="post" class="cabinet-form fl-label-form">
                            @csrf
                            <div class="title">{{ __('site.enter_cabinet') }}</div>

                            <div class="form-group">
                                <label for="input-1">{{ __('site.email_address') }}</label>
                                <input type="text" id="input-1" required class="fl-label" name="email" />
                            </div>
                            <div class="form-group">
                                <label for="input-2">{{ __('site.password') }}</label>
                                <input type="password" id="input-2" required class="fl-label" name="password" />
                                <a href="{{ localize_url('/auth/forgot-password') }}"
                                    class="lost-password">{{ __('site.lost_password_question') }}</a>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <input type="checkbox" id="supplier" name="remember_me" value="1" />
                                    <label for="supplier"> {{ __('site.remember_me') }} </label>
                                </div>
                            </div>
                            <div class="form-error">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="form-error">
                                @error('password')
                                    {{ $message }}
                                @enderror
                            </div>

                            <button class="btn btn--primary w-100" type="submit">{{ __('site.login') }}</button>
                        </form>
                    </div>
                    <div class="tabContent">
                        <form action="{{ route('register') }}" method="post" class="cabinet-form fl-label-form">
                            @csrf

                            <div class="title">{{ __('site.register_new_user') }}</div>
                            <div class="text">{{ __('site.new_password_mail_will_be_sent') }}</div>
                            <div class="form-group">
                                <label for="name">{{ __('site.your_name') }}</label>
                                <input type="text" id="name" required
                                    class="fl-label @error('name') is-invalid @enderror" name="name" />
                            </div>
                            <div class="form-group">
                                <label for="email">{{ __('site.email_address') }}</label>
                                <input type="email" id="email" required
                                    class="fl-label @error('email') is-invalid @enderror" name="email" />
                            </div>
                            <div class="form-error">
                                @error('email')
                                    {{ $message }}
                                @enderror
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <button class="btn btn--primary w-100" type="submit">{{ __('site.register_action') }}</button>
                            <div class="sub-text">
                                {{ __('site.your_personal_data_message') }}
                                <a href="{{ localize_url('/privacy-policy') }}">{{ __('site.privacy_policy') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
