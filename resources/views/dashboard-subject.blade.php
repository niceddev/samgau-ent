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

                <div class="left-side col-5 px-5">

                    <p class="subject-title fs-2 text-center">
                        {{ $subject->getTranslation('name', session()->get('lang', 'ru')) }}
                    </p>

                    <div class="calendar">

                        <div>
                            <div id="year-tab" class="visually-hidden nav nav-tabs" role="tablist">
                                @foreach($dates as $date)
                                    <span id="tab-{{ $date->year }}" class="nav-link @if($loop->first)active @endif"
                                          data-bs-toggle="tab" data-bs-target="#year-{{ $date->year }}"
                                          type="button" role="tab"
                                          aria-labelledby="nav-{{ $date->year }}"></span>
                                @endforeach
                            </div>
                            <div class="d-flex justify-content-around">
                                <div>
                                    prev
                                </div>
                                <div>
                                    January
                                </div>
                                <div>
                                    next
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            @foreach(['ПОН', 'ВТР', 'СРД', 'ЧЕТ', 'ПЯТ', 'СУБ', 'ВОС'] as $day)
                                <span class="col text-center my-2 p-0 week">{{ $day }}</span>
                            @endforeach
                        </div>
                        <div>



                        </div>
                    </div>

                    <div class="test-results">
                        <p>{{ __('common.test_results') }}</p>

                        <div>

                        </div>

                    </div>

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
