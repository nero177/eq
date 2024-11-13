@extends('layouts.front')
@section('content')
    <main class="cabinet">
        <div class="content wrapper">
            <x-cabinet-navigation />

            <div class="cabinet-subtitle">{!! __('site.edit_data') !!}</div>

            <form action="{{ route('user.edit') }}" method="post" class="cabinet-form cabinet-form-edit fl-label-form">
                @csrf
                <div class="title">{{ __('site.profile_details') }}</div>
                <div class="form-group">
                    <label for="input-1">{{ __('site.edit_name') }} *</label>
                    <input type="text" id="input-1" required class="fl-label" name="name"
                        value="{{ auth()->user()->name }}" />
                </div>
                <div class="form-error">
                    @error('name')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-group">
                    <label for="input-2">{{ __('site.surname') }} *</label>
                    <input type="text" id="input-2" required class="fl-label" name="surname"
                        value="{{ auth()->user()->surname }}" />
                </div>
                <div class="form-error">
                    @error('surname')
                        {{ $message }}
                    @enderror
                </div>
                <div class="form-error">
                    @error('password')
                        {{ $message }}
                    @enderror
                </div>
                {{-- <div class="form-group">
                    <label for="input-3">відображуване ім’я *</label>
                    <input type="text" id="input-3" required class="fl-label" name="login3" value="Світлана" />
                </div> --}}
                <div class="text-info">
                    {{ __('site.profile_edit_name_message') }}
                </div>
                {{-- <div class="form-group">
                    <label for="input-4">e-mail *</label>
                    <input type="email" id="input-4" required class="fl-label" name="login4"
                        value="svitlana@mail.com" />
                </div> --}}
                <div class="title">{{ __('site.password_change') }}</div>
                <div class="form-group">
                    <label for="input-5">{{ __('site.current_password') }}</label>
                    <input type="password" id="input-5" class="fl-label" name="current_password" />
                </div>
                <div class="form-group">
                    <label for="input-6">{{ __('site.new_password') }}</label>
                    <input type="password" id="input-6" class="fl-label" name="new_password" />
                </div>

                <div class="form-error">
                    @error('error')
                        {{ $message }}
                    @enderror
                </div>

                <button class="btn btn--primary w-100" type="submit">{{ __('site.save_changes') }}</button>
            </form>
        </div>
    </main>
@endsection
