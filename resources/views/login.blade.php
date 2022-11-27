@extends('layouts.app')

@section('title')
    Логин
@endsection()

@section('content')
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-danger fs-1">{{ $error }}</p>
            @endforeach
        @endif
        <div class="bg-white container rounded-5 p-0">
            <div class="row">
                <div class="col px-5">
                    <form action="{{ route('login.store') }}" method="POST" class="position-relative">
                        <div id="lang_switcher" class="position-absolute" style="left: 40px; top: 40px;">
                            @foreach(config('app.languages') as $key => $lang)
                                <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                                   {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                                   data-value="{{ $key }}">
                                    {{ $lang }}
                                </a>
                            @endforeach
                        </div>
                        @csrf
                        <div class="row py-4">
                            <h1 class="text-center fw-bold" style="color: #2F327D; font-size: 55px;">
                                {{ mb_strtoupper(__('common.sign_in')) }}
                            </h1>
                        </div>

                        <div class="row px-5">
                            <div class="d-flex align-items-center justify-content-between">
                                <label for="login" class="custom-label">{{ __('common.login') }}:</label>
                                <a href="#" class="golden-text">{{ __('common.link_sign_in') }}:</a>
                            </div>
                            <input id="login" name="login"
                                   value="{{ old('login') }}"
                                   class="custom-input border-0 rounded-3" type="text" required placeholder="{{ __('common.enter_login') }}">
                        </div>

                        <div class="row px-5 mt-5">
                            <label for="password" class="custom-label">{{ __('common.password') }}:</label>
                            <input id="password" name="password"
                                   class="custom-input border-0 rounded-3" type="password" required placeholder="{{ __('common.enter_password') }}">

                            <div class="d-flex align-items-center justify-content-between mt-1">
                                <div>
                                    <input type="checkbox" value="lsRememberMe" id="rememberMe">
                                    <label class="golden-text mx-1 text-decoration-underline" for="rememberMe">{{ __('common.remember_me') }}</label>
                                </div>
                                <div>
                                    <a href="#" class="golden-text">{{ __('common.forget_password') }}</a>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <button type="submit" class="login-btn text-white fs-2 p-4 w-50 mx-auto rounded-3 border-0">
                                {{ __('common.sign_in') }}
                            </button>
                        </div>

                    </form>
                </div>
                <div class="col-4">
                    <img class="float-end" src="{{ asset('assets/login_kid.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
