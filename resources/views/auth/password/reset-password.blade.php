@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <div class="cabinet-wrap tabs js-tabs-simple">
                <form action="{{ route('password.update') }}" method="post" class="cabinet-form fl-label-form">
                    @csrf
                    <div class="title">{{ __('site.reset_password') }}</div>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" id="input-1" required class="fl-label" name="email" value="{{ request()->email }}"/>

                    <div class="form-group">
                        <label for="input-2">{{ __('site.new_password') }}</label>
                        <input type="text" id="input-2" required class="fl-label" name="password" />
                    </div>
                    <div class="form-group">
                        <label for="input-3">{{ __('site.new_password_repeat') }}</label>
                        <input type="password" id="input-3" required class="fl-label" name="password_confirmation" />
                    </div>
                    <div class="form-error">
                        @error('email')
                            {{ __('site.email_address') }}: {{ $message }}
                        @enderror
                        @error('token')
                            token: {{ $message }}
                        @enderror
                        @error('password')
                            {{ __('site.password') }}: {{ $message }}
                        @enderror
                    </div>

                    <button class="btn btn--primary w-100" type="submit">{{ __('site.reset') }}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
