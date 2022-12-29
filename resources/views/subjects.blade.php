@extends('layouts.app')

@section('title')
    {{ __('common.subjects') }}
@endsection()

@section('content')
    <div id="thin-container" style="margin: 15px auto">

        <div id="lang_switcher" class="d-flex justify-content-between">
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
            <form id="subjectsForm" action="{{ route('test.index') }}" method="GET" class="d-inline-flex justify-content-center">
                <div class="col-sm-5">
                    <h4 class="secondary text-center mb-3 mt-2 fs-5">
                        {{ __('common.must_subjects_title') }}
                    </h4>
                    <div class="row">
                        @foreach($subjects->where('required', true) as $requiredSubject)
                            <div class="text-center mb-3">
                                <input type="hidden" name="subjects[]" value="{{ $requiredSubject->id }}">
                                <label class="p-3 rounded-4 custom-checkbox d-flex justify-content-center"
                                       style="margin:0 auto;width:144px;height:144px;background-color: {{ $requiredSubject->color }}">
                                    <img src="{{ asset($requiredSubject->image_path) }}" alt="">
                                    <input type="checkbox" checked disabled name="subjects[]" value="{{ $requiredSubject->id }}">
                                    <span class="checkmark"></span>
                                </label>
                                <h4 class="mt-4 fs-5" style="width:150px;margin:0 auto;color:#737373;">
                                    {{ $requiredSubject->getTranslation('name',  session()->get('lang', 'ru')) }}
                                </h4>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-sm-9">
                    <h4 class="mb-3 mt-2 fs-5 text-center">
                        {{ __('common.subjects_by_profile') }}
                    </h4>
                    <div class="row flex justify-content-center">
                        @foreach($subjects->where('required', false) as $subject)
                            <div class="col-sm-4 overflow-hidden subjects" data-id="{{ $subject->id }}" data-siblings="{{ json_encode($subject->siblings) }}">
                                <div class="text-center">
                                    <label class="d-grid">
                                        <label data-id="{{ $subject->id }}" class="p-3 mb-2 rounded-4 custom-checkbox subject-label img d-flex justify-content-center"
                                               style="margin:0 auto;width:90px;height:90px;background-color: {{ $subject->color }};" data-color="{{ $subject->color }}">
                                            <img class="subject" src="{{ asset($subject->image_path) }}" alt="" >
                                            <input class="subject-item" type="checkbox" name="subjects[]" value="{{ $subject->id }}" data-siblings="{{ json_encode($subject->siblings) }}">
                                            <span class="little-checkmark"></span>
                                        </label>
                                        <h4 class="break-words" style="color: #737373;">
                                            {{ $subject->id . ' - '. $subject->getTranslation('name',  session()->get('lang', 'ru')) }}
                                        </h4>
                                    </label>
                                </div>
                            </div>
                        @endforeach
                        <div class="row">
                            <button type="submit" form="subjectsForm" class="login-btn text-white fs-2 mt-2 p-3 rounded-4 border-0"
                                disabled style="filter: grayscale(100%)">
                                {{ __('common.start_test') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
