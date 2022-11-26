@extends('layouts.app')

@section('title')
    Предметы
@endsection()

@section('content')
    <div id="thin-container">
        <div id="lang_switcher" class="mb-2">
            @foreach(config('app.languages') as $key => $lang)
                <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                    {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                    data-value="{{ $key }}">
                    {{ $lang }}
                </a>
            @endforeach
        </div>
        <h3>Выберите специализацию и пройдите ЕНТ</h3>
    <!-- write  two columns sm-6 from bootstrap grid  -->
        <div class="row">
            <div class="col-sm-6">
                <h4 class="secondary text-center mb-3 mt-2">
                    Обязательные
                </h4>
                <div class="row">
                    @foreach($mustSubjects as $subject)
                        <div class="text-center subject-card mb-4">
                            <a href="#" class="text-decoration-none">
                                <img class="subject mb-3" src="{{ asset($subject->image_path) }}" alt="" >
                                <div class="checksign"></div>
                                <h4 style="color: #737373;">{{ $subject->getTranslation('name',  session()->get('lang', 'ru')) }}</h4>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-6">
                <h4 class="mb-3 mt-2">
                    Предметы по профилю
                </h4>
                <div class="row">
                    @foreach($subjects as $subject)
                        <div class="col-sm-6 mb-2">
                            <div class="text-center">
                                <a href="#" class="text-decoration-none">
                                    <img class="mb-2" src="{{ asset($subject->image_path) }}" alt="" >
                                    <h4 style="color: #737373;">{{ $subject->name }}</h4>
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
