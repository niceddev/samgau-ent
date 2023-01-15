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
    <div id="analyticsPage">
        <div class="bg-white container rounded-4" style="padding: 116px 0">
            <div class="row">




            </div>
        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>

@endsection
