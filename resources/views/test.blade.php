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
                    <div style="min-height: 120px;" class="overflow-hidden">
                        <div class="grid main" id="subjects">
                            <div class="items">
                                @foreach($subjects as $subject)
                                    <div class="item col-sm-2">
                                        <img src="{{ asset($subject->image_path) }}" alt="">
                                        <h4>{{ $subject->name }}</h4>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
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
