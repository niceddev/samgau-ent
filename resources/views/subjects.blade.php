@extends('layouts.app')

@section('title')
    {{ __('common.subjects') }}
@endsection()

@section('content')
    <div id="thin-container">

        <div id="lang_switcher" class="mb-2 d-flex justify-content-between">
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

        <h3 class="fs-3 text-center mt-5">{{ __('common.choose_profile_and_start') }}</h3>

        <div class="row">
            <form id="subjectsForm" action="{{ route('test.index') }}" method="POST" class="d-inline-flex">
                @csrf
                <div class="col-sm-6">
                    <h4 class="secondary text-center mb-3 mt-2 fs-5">
                        {{ __('common.must_subjects_title') }}
                    </h4>
                    <div class="row">
                        @foreach($subjects->where('required', true) as $mustSubject)
                            <div class="text-center subject-card mb-3">
                                <label class="d-grid">
                                    <input type="checkbox" checked disabled name="subjects[]" class="hidden subject-checkbox" value="{{ $mustSubject->id }}">
                                    <input type="hidden" name="subjects[]" value="{{ $mustSubject->id }}">
                                    <svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.00977 8.4026L6.21309 14.5815L20.197 1.57324" stroke="white" stroke-width="1.95124" stroke-linecap="round"/>
                                    </svg>
                                    <div class="p-3 mb-2 rounded-4" style="margin:0 auto;width:144px;height:144px;background-color: {{ $mustSubject->color }}">
                                        <img class="subject mb-3" src="{{ asset($mustSubject->image_path) }}" alt="">
                                    </div>
                                    <h4 class="text-center mt-3 px-5 fs-5" style="color:#737373;">
                                        {{ $mustSubject->getTranslation('name',  session()->get('lang', 'ru')) }}
                                    </h4>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-6">
                    <h4 class="mb-3 mt-2 fs-5 text-center">
                        {{ __('common.subjects_by_profile') }}
                    </h4>
                    <div class="row flex justify-content-center">
                        @foreach($subjects->where('required', false) as $subject)
                            <div class="col-sm-6 overflow-hidden subjects" data-id="{{ $subject->id }}" data-siblings="{{ json_encode($subject->siblings) }}">
                                <div class="text-center">
                                    <label class="d-grid">
                                        <input type="checkbox" name="subjects[]" class="hidden subject-checkbox" value="{{ $subject->id }}">
                                        <div class="mb-1 rounded-3 py-3 img" style="margin:0 auto;width:90px;height:90px;background-color: {{ $subject->color }};cursor: pointer">
                                            <img style="max-height: 60px;" src="{{ asset($subject->image_path) }}" alt="">
                                        </div>
                                        <h4 class="break-words" style="color: #737373;">
                                            {{ $subject->getTranslation('name',  session()->get('lang', 'ru')) }}
                                        </h4>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>

        <div class="row my-4">
            <button type="submit" form="subjectsForm" class="login-btn text-white fs-2 p-4 w-50 mx-auto rounded-3 border-0">
                {{ __('common.start_test') }}
            </button>
        </div>
    </div>

    @push('custom-scripts')
        <script src="{{ asset('js/choose-subjects.js') }}"></script>
    @endpush
    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
