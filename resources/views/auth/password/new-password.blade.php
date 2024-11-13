@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <div class="cabinet-wrap tabs js-tabs-simple">
                <form action="{{ route('password.new') }}" method="post" class="cabinet-form fl-label-form">
                    @csrf
                    <div class="title">{{ __('site.new_password') }}</div>

                    <div class="form-group">
                        <label for="input-1">{{ __('site.current_password') }} ({{ __('site.from_mail') }})</label>
                        <input type="text" id="input-1" required class="fl-label" name="current_password" />
                    </div>
                    <div class="form-group">
                        <label for="input-2">{{ __('site.new_password') }}</label>
                        <input type="password" id="input-2" required class="fl-label" name="new_password" />
                    </div>
                    <div class="form-error">
                        @error('current_password')
                            {{ $message }}
                        @enderror
                        @error('new_password')
                            {{ $message }}
                        @enderror
                    </div>

                    <button class="btn btn--primary w-100" type="submit">{{ __('site.set') }}</button>
                </form>
            </div>
        </div>
    </main>
@endsection
