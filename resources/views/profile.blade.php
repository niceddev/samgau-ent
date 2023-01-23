@extends('layouts.app')

@section('title')
    {{ __('common.profile') }}
@endsection()

@section('content')
    <div id="thin-container">
        <div id="lang_switcher" class="mb-5 d-flex justify-content-between" style="font-size: 18px">
            <div>
                @foreach(config('app.languages') as $key => $lang)
                    <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                       {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                       data-value="{{ $key }}">
                        {{ $lang }}
                    </a>
                @endforeach
            </div>
            <div>
                <a href="{{ route('cabinet.index') }}" class="back_btn px-3">
                    {{ __('common.to_back') }}
                </a>
            </div>
        </div>

        <h3 class="text-center mt-5" style="font-size: 47px !important;">{{ __('common.profile') }}</h3>

        <div id="profilePage" class="row pt-4 mt-5">

            <div class="row">
                <p class="profile-title">{{ __('common.fio') }}</p>
                <p class="profile-text">{{ $student->fio }}</p>
            </div>

            <div class="row">
                <p class="profile-title">{{ __('common.email') }}</p>
                <p class="profile-text">{{ $student->email }}</p>
            </div>

            <div class="row">
                <p class="profile-title">{{ __('common.school') }}</p>
                <p class="profile-text">{{ $student->school->title }}</p>
            </div>

            <div class="row">
                <p class="profile-title">{{ __('common.grade') }}</p>
                <p class="profile-text">{{ $student->grade_number . $student->grade_letter }}</p>
            </div>

        </div>

    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
