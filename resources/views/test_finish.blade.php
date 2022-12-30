@extends('layouts.app')

@section('title')
    Вы завершили тест!
@endsection()

@section('content')
    <div id="test-finish" class="container" style="margin-top: 90px; padding: 0px 100px 50px 100px">

        <div class="d-flex justify-content-between mb-5">
            <div>
                <h1 class="text-black" style="font-size: 55px">
                    {{ __('common.you_have_completed_the_test') }}
                </h1>
                <h2 class="text-black" style="font-size: 35px">
                    {{ __('common.check_out_the_test_results') }}
                </h2>
            </div>
            <div>
                <div class="fs-4 rounded-4 px-5 text-white text-center" style="background-color:#2F327D">
                    <p class="mb-0 fw-lighter">{{ __('common.execution_time') }}</p>
                    <p class="mb-0 fs-2">99 мин 99 сек</p>
                </div>
            </div>
        </div>

        <div class="d-flex">
            <div>
                <ul>
                    @foreach([1,2,3,4,5] as $subject)
                        <li>Математическая грамотность <span class="fw-bold">{{ $subject .'/'.$subject }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="results">
                <p class="results-title text-center">{{ __('common.your_results') }}</p>
                <canvas id="resultsDoughnut" width="235" height="235"></canvas>
            </div>
        </div>

        <div class="d-flex gap-3" style="margin-top: 180px">

            <a href="" class="btns d-flex align-items-center">
                {{ __('common.work_on_mistakes') }}
            </a>

            <a href="" class="btns d-flex align-items-center">
                {{ __('common.repeat_test') }}
            </a>

            <a href="" class="btns d-flex align-items-center">
                {{ __('common.statistics') }}
            </a>

            <a href class="btns d-flex align-items-center">
                {{ __('common.exit_test') }}
            </a>

        </div>
    </div>

    @push('custom-scripts')
        <script src="{{ asset('js/chart.umd.js') }}"></script>
        <script src="{{ asset('js/results-doughnut.js') }}"></script>
    @endpush

@endsection
