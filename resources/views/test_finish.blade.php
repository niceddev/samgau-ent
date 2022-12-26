@extends('layouts.app')

@section('title')
    Вы завершили тест!
@endsection()

@section('content')
    <div style="display: none">
        <div id="thin-container">

            <div id="lang_switcher" class="mb-2 d-flex justify-content-between">
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
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <h4 class="mb-3 mt-2 fs-5 text-center">
                            {{ __('common.subjects_by_profile') }}
                        </h4>
                        <div class="row flex justify-content-center">
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
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>

@endsection
