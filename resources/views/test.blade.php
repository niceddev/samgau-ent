@extends('layouts.app')

@section('title')
    Тест
@endsection()

@section('content')
    <div id="container" class="test-page">
        <div class="row">
            <div class="col-sm-1" id="steps">
                <h3>ТЕСТ</h3>
                <span class="active_text">Активен</span>
                <h4 class="active_text">7/15</h4>
                <ol id="myTab" role="tablist">
                    @foreach($questions as $question)
                        <button class="bg-transparent border-0"
                                id="{{ $question->id }}-tab" type="button" role="tab" aria-controls="tab-{{ $question->id }}" aria-selected="false"
                                data-bs-toggle="tab" data-bs-target="#tab-{{ $question->id }}">
                            <li>
                            </li>
                        </button>
                    @endforeach
                </ol>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    @foreach($subjects as $subject)
                        <div class="col-sm-2 subject_option_parent">
                            <div class="subject_option" id="physics_option">
                            </div>
                            <h4>Физика</h4>
                        </div>
                    @endforeach
                </div>
                <div class="row">

                    <div class="tab-content" id="myTabContent">
                        @foreach($questions as $question)
                            <div class="tab-pane fade" id="tab-{{ $question->id }}"
                                 role="tabpanel" aria-labelledby="{{ $question->id }}-tab" tabindex="0">
                                {{ $question->question }}
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
@endsection
