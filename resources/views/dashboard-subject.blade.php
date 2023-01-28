@extends('layouts.app')

@section('title')
    Главная панель
@endsection()

@section('content')
{{--    <div id="lang_switcher" class="d-flex justify-content-between position-absolute p-4">--}}
{{--        <div>--}}
{{--            @foreach(config('app.languages') as $key => $lang)--}}
{{--                <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"--}}
{{--                   {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}--}}
{{--                   data-value="{{ $key }}">--}}
{{--                    {{ $lang }}--}}
{{--                </a>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--        <a href="{{ route('cabinet.index') }}">--}}
{{--            {{ __('common.cabinet') }}--}}
{{--        </a>--}}
{{--    </div>--}}
    <div id="subjectAnalyticPage">
        <div class="bg-white container rounded-4" style="padding: 116px 0">
            <div class="row d-flex justify-content-between">

                <div class="left-side col-5 px-5">

                    <p class="subject-title fs-2 text-center" style="font-size: 35px !important;">
                        {{ mb_strtoupper($subject->getTranslation('name', session()->get('lang', 'ru'))) }}
                    </p>

                    <div class="calendar">
                        <div>
                            <div id="year-tab" class="visually-hidden nav nav-tabs" role="presentation">
                                @foreach($dates as $date)
                                    <span id="tab-{{ $date->year }}" class="nav-link @if($loop->first)active @endif"
                                          data-bs-toggle="tab" data-bs-target="#year-{{ $date->month }}"
                                          type="button" role="presentation"
                                          aria-labelledby="nav-{{ $date->year }}"></span>
                                @endforeach
                            </div>
                            <div class="tab-content" style="background-color: #A0B5C2; border-radius: 20px 20px 0 0;">
                                @foreach($dates as $date)
                                    <div class="d-flex justify-content-around tab-pane fade @if($loop->first)show active @endif" id="year-{{ $date->month }}" role="tabpanel">
                                        <div class="prev-month">
                                            prev
                                        </div>
                                        <div>
                                            {{ $date->month }}
                                        </div>
                                        <div class="next-month">
                                            next
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            @foreach(['ПОН', 'ВТР', 'СРД', 'ЧЕТ', 'ПЯТ', 'СУБ', 'ВОС'] as $day)
                                <span class="col text-center my-2 p-0 week">{{ $day }}</span>
                            @endforeach
                        </div>

                        <div class="tab-content">
                            @foreach($dates as $date)
                                <div class="d-flex justify-content-around tab-pane fade @if($loop->first)show active @endif" id="year-{{ $date->month }}" role="tabpanel">
                                    @for($i = 0; $i <= $date->days; $i++)
                                        <a class="" href="{{ $date->month }}/{{ $i }}">
                                            {{ $i }}
                                        </a>
                                    @endfor
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="test-results my-4">
                        <p class="subject-title fs-2 text-center text-white" style="font-size: 25px !important;">
                            {{ mb_strtoupper(__('common.test_results')) }}
                        </p>

                        <div style="background: #CFDAE0; border-radius: 20px; width: 330px; height: 200px;">

                        </div>

                    </div>

                </div>

                <div class="right-side col-7 rounded-5 p-4" style="background-color: #A0B5C2">

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4" style="background-color: #A0B5C2">
                            {{ mb_strtoupper(__('common.question')) }}
                        </div>
                        <div class="content-side col-7" >
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4">
                            {{ mb_strtoupper(__('common.answer')) }}
                        </div>
                        <div class="content-side col-7" >
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around mb-4">
                        <div class="title-side col-4">
                            {{ mb_strtoupper(__('common.grade')) }}
                        </div>
                        <div class="content-side col-7">
                            asdasda
                        </div>
                    </div>

                    <div class="row gap-1 d-flex justify-content-around">
                        <div class="title-side col-4">
                            {{ mb_strtoupper(__('common.topic')) }}
                        </div>
                        <div class="content-side col-7">
                            asdasda
                        </div>
                    </div>
                    <input type="month" id="asd">

                </div>

            </div>
            <div class="float-end mt-4">
                <a href="" class="text-white p-1 px-4 rounded-4 text-decoration-none mx-4" style="font-size: 40px; background-color: #FBA333">
                    {{ __('common.begin_test_again') }}
                </a>
                <a href="{{ route('cabinet.index') }}" class="text-white p-1 px-4 rounded-4 text-decoration-none" style="font-size: 40px; background-color: #FBA333">
                    {{ __('common.return_back') }}
                </a>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @push('custom-scripts')
        <script src="{{ asset('js/dashboard-calendar.js') }}"></script>
    @endpush
    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>

@endsection
