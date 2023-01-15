@extends('layouts.app')

@section('title')
    Главная панель
@endsection()

@section('content')
    <div id="lang_switcher" class="d-flex justify-content-between position-absolute p-4">
        <div>
            @foreach(config('app.languages') as $key => $lang)
                <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                   {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                   data-value="{{ $key }}">
                    {{ $lang }}
                </a>
            @endforeach
        </div>
        <a href="{{ route('cabinet.index') }}">
            {{ __('common.cabinet') }}
        </a>
    </div>
    <div id="subjectAnalyticPage">
        <div class="bg-white container rounded-4" style="padding: 116px 0">
            <div class="row d-flex justify-content-between">

                <div class="left-side bg-danger col-5">

                    <p class="analytics-title fs-2 text-center">
                        {{ $subject->getTranslation('name', session()->get('lang', 'ru')) }}
                    </p>

                </div>

                <div class="right-side col-7 rounded-5 p-4" style="background-color: #A0B5C2">

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4" style="background-color: #A0B5C2">
                            {{ __('common.question') }}
                        </div>
                        <div class="content-side col-7" >
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4">
                            {{ __('common.answer') }}
                        </div>
                        <div class="content-side col-7" >
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4">
                            {{ __('common.grade') }}
                        </div>
                        <div class="content-side col-7">
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around">
                        <div class="title-side col-4">
                            {{ __('common.topic') }}
                        </div>
                        <div class="content-side col-7">
                            asdasda
                        </div>
                    </div>


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
