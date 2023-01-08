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
    <div id="analyticsPage">
        <div class="bg-white container rounded-4" style="padding: 116px 0">
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

                <div>
                    <p class="analytics-title">
                        {{ __('common.test_analytics') }}
                    </p>
                </div>

                <div class="subjects-section py-2 d-flex justify-content-between">
                    <div class="left-side">
                        <p class="analytics-title">
                            {{ __('common.subjects') }}
                        </p>
                        <ul class="analytics-subjects">
                            @foreach($subjects as $subject)
                                <li>
                                    <a href="#{{$subject->id}}">
                                        {{ $subject->getTranslation('name', session()->get('lang', 'ru')) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-side">
                        <p class="analytics-title">
                            {{ __('common.analytics') }}:
                        </p>
                        <div class="d-flex">
                            <div>
                                <canvas id="anayticsPie" width="291" height="291"></canvas>
                            </div>
                            <div>

                            </div>
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

    @push('custom-scripts')
        <script src="{{ asset('js/chart.umd.js') }}"></script>
        <script src="{{ asset('js/analytics-pie.js') }}"></script>
    @endpush

@endsection
