@extends('layouts.app')

@section('title')
    Вы завершили тест!
@endsection()

@section('content')
    <div id="test-finish" class="container shadow-lg" style="margin-top: 120px; padding: 50px 100px 50px 100px">

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

        <div class="d-flex justify-content-between">
            <div class="p-2" style="border-right: 2px solid #000">
                <ul>
                    @foreach([1,2,3,4,5] as $subject)
                        <li>Matematika {{ $subject }}</li>
                    @endforeach
                </ul>
            </div>
            <div>

            </div>
        </div>

        <div class="d-flex gap-3 mt-5">

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

    <script src="{{ asset('js/bootstrap.js') }}"></script>

@endsection
