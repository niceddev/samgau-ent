@extends('layouts.app')

@section('title')
    {{ __('common.cabinet') }}
@endsection()

@section('content')
    <div id="thin-container">
        <div id="lang_switcher" class="mb-2">
            <div>
                @foreach(config('app.languages') as $key => $lang)
                    <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                       {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                       data-value="{{ $key }}">
                        {{ $lang }}
                    </a>
                @endforeach
            </div>
        </div>
        <h3 class="fs-2 text-center mt-5">{{ __('common.cabinet') }}</h3>
        <div class="row text-white fs-3 flex justify-content-center pt-4">
            <div class="col-sm-6 text-center">

                <div class="row rounded-5 flex justify-content-center" style="background-color:#0080C2">
                    <a class="link-light text-decoration-none" href="{{ route('dashboard.index') }}">
                        <img class="mt-4" src="{{ asset('assets/analytics.png') }}" alt="" style="width:150px;height: 110px">
                        <p>{{ __('common.analytics') }}</p>
                    </a>
                </div>

                <div class="row rounded-5 flex justify-content-center mt-5" style="background-color:#2F327D">
                    <a class="link-light text-decoration-none" href="{{ route('subjects') }}">
                        <img class="mt-4" src="{{ asset('assets/bank.png') }}" alt="" style="width:90px;height: 110px">
                        <p>{{ __('common.subjects') }}</p>
                    </a>
                </div>

            </div>

            <div class="row mt-5">
                <button type="submit" class="rounded-4 text-white p-2 mx-auto border-0" style="background-color:#EDB021">
                    {{ __('common.talk_with_tp') }}
                </button>
            </div>

            <div class="row mt-4">
                <button type="submit" class="rounded-4 text-white p-2 mx-auto border-0" style="background-color:#EDB021">
                    {{ __('common.consultation') }}
                </button>
            </div>

            <div class="row mt-4">
                <button type="submit" form="logout-form" class="rounded-4 text-white p-2 mx-auto border-0" style="background-color:#EDB021">
                    {{ __('common.log_out') }}
                </button>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="GET">
                @csrf
            </form>

        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
