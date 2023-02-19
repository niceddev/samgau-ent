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
        <div class="bg-white container rounded-4" style="padding: 56px 0">
            <div class="row d-flex justify-content-between">

                <div class="left-side col-5 px-5">

                    <p class="subject-title fs-2 text-center" style="font-size: 35px !important;">
                        {{ mb_strtoupper($subject->getTranslation('name', session()->get('lang', 'ru'))) }}
                    </p>

                    <div class="calendar pb-4">
                        <div class="text-center text-white" style="border-radius: 20px 20px 0 0; background-color: #A0B5C2; font-size: 37px">
                            <input type="month" id="calendarMonths" name="calendar">
                        </div>

                        <div style="width: 326px; margin: 0 auto">
                            <div class="row mt-3">
                                @foreach(['ПОН', 'ВТР', 'СРД', 'ЧЕТ', 'ПЯТ', 'СУБ', 'ВОС'] as $day)
                                    <span class="col text-center p-0 week">{{ $day }}</span>
                                @endforeach
                            </div>

                            <div class="calendar-days"></div>
                        </div>

                    </div>

                    <div class="test-results my-4">
                        <p class="subject-title fs-2 text-center text-white" style="font-size: 25px !important;">
                            {{ mb_strtoupper(__('common.test_results')) }}
                        </p>

                        <div class="p-3 container" style="background: #CFDAE0; border-radius: 20px;">
                            <div class="row row-cols-6 px-4 p-1" role="tablist">
                                @foreach($latestTestSubject->subjectQuestions ?? [] as $key => $question)
                                    <button class="col text-center correct @if($loop->first) active @endif" data-bs-toggle="tab" role="tab"
                                         data-bs-target="#question-{{ $question->id }}"
                                         id="question-{{ $question->id }}-tab" role="presentation">
                                        {{ $key + 1 }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>

                <div class="right-side col-7 rounded-5 p-4" style="background-color: #A0B5C2">

                    <div class="tab-content" id="myTabContent">
                        @foreach($latestTestSubject->subjectQuestions ?? [] as $key => $question)
                            <div class="tab-pane fade @if($loop->first)show active @endif"
                                 id="question-{{ $question->id }}" role="tabpanel"
                                 aria-labelledby="question-{{ $question->id }}-tab">

                                <div class="row gap-1 d-flex justify-content-around mb-4">
                                    <div class="title-side col-4" style="background-color: #A0B5C2">
                                        {{ mb_strtoupper(__('common.question')) }}
                                    </div>
                                    <div class="content-side col-7" >
                                        {{ $question->question->getTranslation('question', session()->get('lang', 'ru')) }}
                                    </div>
                                </div>

                                <div class="row gap-1 d-flex justify-content-around mb-4">
                                    <div class="title-side col-4">
                                        {{ mb_strtoupper(__('common.answer')) }}
                                    </div>
                                    <div class="content-side col-7" >
                                        @foreach($question->question->options as $optionKey => $option)
                                            {{ chr($optionKey+65) . ') ' . $option->getTranslation('option', session()->get('lang', 'ru')) }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row gap-1 d-flex justify-content-around mb-4">
                                    <div class="title-side col-4">
                                        {{ mb_strtoupper(__('common.grade')) }}
                                    </div>
                                    <div class="content-side col-7 text-decoration-underline">
                                        {{ $question->test->studentId->grade_number }} КЛАСС
                                    </div>
                                </div>

                                <div class="row gap-1 d-flex justify-content-around mb-4">
                                    <div class="title-side col-4">
                                        {{ mb_strtoupper(__('common.topic')) }}
                                    </div>
                                    <div class="content-side col-7">
                                        {{ $question->question->getTranslation('topic', session()->get('lang', 'ru')) }}
                                    </div>
                                </div>

                                <div class="row gap-1 d-flex justify-content-around">
                                    <div class="title-side col-4">
                                        {{ mb_strtoupper(__('common.fix_mistakes')) }}
                                    </div>
                                    <div class="content-side col-7">
                                        <a href class="text-white">ссылка на тему урока, в котором ошибся ученик</a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>

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
