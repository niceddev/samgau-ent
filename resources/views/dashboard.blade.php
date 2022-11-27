@extends('layouts.app')

@section('title')
    Главная панель
@endsection()

@section('content')
    <div id="lang_switcher" class="position-absolute p-4">
        @foreach(config('app.languages') as $key => $lang)
            <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
               {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
               data-value="{{ $key }}">
                {{ $lang }}
            </a>
        @endforeach
    </div>
    <div class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <div class="bg-white container rounded-4">
            <div class="row">

                <div class="container text-center">
                    <div class="info-cards row p-2">
                        <div class="col rounded-4 m-2">
                            <p class="info-title m-0">{{ __('common.passed_tests_count') }}:</p>
                            <p class="digit">0</p>
                        </div>
                        <div class="col rounded-4 m-2">
                            <p class="info-title m-0">{{ __('common.max_score') }}:</p>
                            <p class="digit">0</p>
                        </div>
                        <div class="col rounded-4 m-2">
                            <p class="info-title m-0">{{ __('common.average_score') }}:</p>
                            <p class="digit">0</p>
                        </div>
                    </div>
                </div>

                <div class="py-4">
                    Аналитика тестирования
                </div>

                <div class="py-4">
                    Предметы
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
