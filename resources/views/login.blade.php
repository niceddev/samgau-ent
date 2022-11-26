@extends('layouts.app')

@section('title')
    Логин
@endsection()

@section('content')
    <div class="login-page d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="bg-white container rounded-5 p-0">
            <div class="row">
                <div class="col">
                    <div class="row py-4">
                        <h1 class="text-center fw-bold" style="color: #2F327D; font-size: 55px;">
                            {{ mb_strtoupper(__('common.sign_in')) }}
                        </h1>
                    </div>
                    <div class="row px-5">
                        <label for="login" class="login-label">{{ __('common.login') }}:</label>
                        <input id="login" class="login-input border-0 rounded-3" type="text" placeholder="{{ __('common.enter_login') }}">
                    </div>
                    <div class="row"></div>
                    <div class="row"></div>
                </div>
                <div class="col-4">
                    <img class="float-end" src="{{ asset('assets/login_kid.png') }}" alt="">
                </div>
            </div>
        </div>
    </div>
{{--        <div id="lang_switcher" class="mb-2">--}}
{{--            @foreach(config('app.languages') as $key => $lang)--}}
{{--                <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"--}}
{{--                    {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}--}}
{{--                    data-value="{{ $key }}">--}}
{{--                    {{ $lang }}--}}
{{--                </a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-6">--}}
{{--                <h4 class="secondary text-center mb-3 mt-2">--}}
{{--                    Обязательные--}}
{{--                </h4>--}}
{{--                <div class="row">--}}
{{--                    @foreach($mustSubjects as $mustSubject)--}}
{{--                        <div class="text-center subject-card mb-4">--}}
{{--                            <a href="#" class="text-decoration-none">--}}
{{--                                <img class="subject mb-3" style="max-height: 144px" src="{{ asset($mustSubject->image_path) }}" alt="" >--}}
{{--                                <div class="checksign"></div>--}}
{{--                                <h4 style="color: #737373;">{{ $mustSubject->getTranslation('name',  session()->get('lang', 'ru')) }}</h4>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6">--}}
{{--                <h4 class="mb-3 mt-2">--}}
{{--                    Предметы по профилю--}}
{{--                </h4>--}}
{{--                <div class="row">--}}
{{--                    @foreach($subjects as $subject)--}}
{{--                        <div class="col-sm-6 mb-2">--}}
{{--                            <div class="text-center">--}}
{{--                                <a href="#" class="text-decoration-none">--}}
{{--                                    <img class="mb-2" src="{{ asset($subject->image_path) }}" alt="" >--}}
{{--                                    <h4 style="color: #737373;">{{ $subject->getTranslation('name',  session()->get('lang', 'ru')) }}</h4>--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}



    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
