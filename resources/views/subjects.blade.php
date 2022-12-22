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
                                <input type="hidden" name="subjects[]" value="{{ $mustSubject->id }}">
                                <label class="p-3 mb-2 rounded-4 custom-checkbox" style="margin:0 auto;width:144px;height:144px;background-color: {{ $mustSubject->color }}">
                                    <img class="subject mb-3" src="{{ asset($mustSubject->image_path) }}" alt="">
                                    <input type="checkbox" checked disabled name="subjects[]" value="{{ $mustSubject->id }}">
                                    <span class="checkmark"></span>
                                </label>
                                <h4 class="text-center mt-4 px-5 fs-5" style="color:#737373;">
                                    {{ $mustSubject->getTranslation('name',  session()->get('lang', 'ru')) }}
                                </h4>
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
                                        <label class="p-3 mb-2 rounded-4 custom-checkbox img" style="margin:0 auto;width:90px;height:90px;background-color: {{ $subject->color }};">
                                            <img class="subject mb-3" src="{{ asset($subject->image_path) }}" alt="" style="max-height: 60px;">
                                            <input type="checkbox" name="subjects[]" value="{{ $subject->id }}">
                                            <span class="little-checkmark"></span>
                                        </label>
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
