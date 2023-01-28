@extends('layouts.app')

@section('title')
    Главная панель
@endsection()

@section('content')
    <div id="analyticsPage">
        <div class="bg-white container rounded-4" style="padding: 65px 0">
            <a href="{{ route('cabinet.index') }}" class="text-white p-1 px-4 rounded-4 text-decoration-none" style="font-size: 40px; background-color: #FBA333">
                {{ __('common.return_back') }}
            </a>
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
                        <form id="detailed-analytics" action="{{ route('dashboard.detailed') }}" method="GET">
                            <ul class="analytics-subjects">
                                @foreach($studentsSubjects as $subject)
                                    <li>
                                        <label class="text-white w-100">
                                            <input type="radio" class="" id="subjectId{{ $subject->id }}" name="subject-id" value="{{ $subject->id }}">
                                            {{ $subject->getTranslation('name', session()->get('lang', 'ru')) }}
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                    <div class="right-side">
                        <p class="analytics-title">
                            {{ __('common.analytics') }}:
                        </p>
                        <div class="d-flex p-4">
                            <div>
                                <canvas id="anayticsPie" width="291" height="291"></canvas>
                            </div>
{{--                            <div>--}}
{{--                                <ul class="list-unstyled fs-5 p-4">--}}
{{--                                    @foreach($studentsSubjects as $subject)--}}
{{--                                        <li>--}}
{{--                                            <a class="text-white text-decoration-none" href="#{{$subject->id}}">--}}
{{--                                                {{ $subject->getTranslation('name', session()->get('lang', 'ru')) }}--}}
{{--                                                - 99--}}
{{--                                            </a>--}}
{{--                                        </li>--}}
{{--                                    @endforeach--}}
{{--                                </ul>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </div>

            </div>
            <button form="detailed-analytics" class="border-0 mt-2 float-end text-white p-1 px-4 rounded-4 text-decoration-none" style="font-size: 30px; background-color: #FBA333">
                {{ __('common.detailed_analytics') }}
            </button>
        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }

        let lis = Array.from(
            document.querySelectorAll(".analytics-subjects li")
        );

        lis.map((li) => {
            li.addEventListener("click", () => action(li));
            window.onload = (() => action(li));
        });

        function action(li){
            lis.map((_li) => {
                _li.style.background = ""
            });
            let thisRadio = li.querySelector("[type='radio']");
            thisRadio.checked = true;
            li.style.background = "rgba(160, 181, 194, 0.6)"
            li.style.borderRadius = "20px"
        }
    </script>

    @push('custom-scripts')
        <script src="{{ asset('js/chart.umd.js') }}"></script>
        <script src="{{ asset('js/analytics-pie.js') }}"></script>
        <script src="{{ asset('js/chartjs-plugin-datalabels.js') }}"></script>
        <script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
    @endpush

@endsection
