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
            <div class="col-sm-6">
                <h4 class="secondary text-center mb-3 mt-2 fs-5">
                    {{ __('common.must_subjects_title') }}
                </h4>
                <div class="row flex justify-content-center">
                    @foreach($mustSubjects as $mustSubject)
                        <div class="text-center subject-card mb-4">
                            <a href="{{ route('test.index', $mustSubject->id) }}" class="text-decoration-none">
                                <div class="p-3 rounded-3" style="width:144px;height:144px;background-color: {{ $mustSubject->color }}">
                                    <img class="subject mb-3" src="{{ asset($mustSubject->image_path) }}" alt="">
                                </div>
                                <div class="checksign"></div>
                                <h4 style="color: #737373;">{{ $mustSubject->getTranslation('name',  session()->get('lang', 'ru')) }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-6">
                <h4 class="mb-3 mt-2 fs-5 text-center">
                    {{ __('common.subjects_by_profile') }}
                </h4>
                <div class="row flex justify-content-center">
                    @foreach($subjects as $subject)
                        <div class="col-sm-6 mb-2 overflow-hidden">
                            <div class="text-center">
                                <a href="{{ route('test.index', $subject->id) }}" class="text-decoration-none">
                                    <div class="mb-2 p-4 rounded-3" style="width:100px;height:100px;background-color: {{ $subject->color }}">
                                        <img style="max-height: 92px;" src="{{ asset($subject->image_path) }}" alt="" >
                                    </div>
                                    <h4 style="color: #737373;">{{ $subject->getTranslation('name',  session()->get('lang', 'ru')) }}</h4>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
