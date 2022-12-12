@extends('layouts.app')

@section('title')
    Тест
@endsection()

@section('content')
    <div id="container" class="test-page">
        <div class="row">

            <div class="col-sm-1" id="steps">
                <h3>{{ $subject->name }}</h3>
                <span class="active_text">Активен</span>
                <h4 class="active_text"><span class="answers-count">0</span>/{{ $questions->count() }}</h4>
                <ol id="myTab" role="tablist">
                    @foreach($questions as $question)
                        <button class="bg-transparent border-0 @if($loop->first) active @endif"
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
                            <div class="tab-pane fade @if($loop->first) active show @endif" id="tab-{{ $question->id }}"
                                 role="tabpanel" aria-labelledby="{{ $question->id }}-tab" tabindex="0">

                                <p>{{ __('common.question') }}: {{ $question->question }}</p>
                                <p>{!! $question->sub_question !!}</p>

                                <ul>
                                    <li>{{ $question->option_a }}</li>
                                    <li>{{ $question->option_b }}</li>
                                    <li>{{ $question->option_c }}</li>
                                    <li>{{ $question->option_d }}</li>
                                    <li>{{ $question->option_e }}</li>
                                </ul>

                            </div>
                        @endforeach

                        <a class="btn btn-primary btnPrev">Back</a>
                        <a class="btn btn-primary btnNext">Next</a>

                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script>
        const nextBtn = document.querySelectorAll(".btnNext");
        const prevBtn = document.querySelectorAll(".btnPrev");

        nextBtn.forEach(function(item, index){
            item.addEventListener('click', function(){
                let id = index + 1;
                let tabElement = document.querySelectorAll("#myTabContent a")[id];
                var lastTab = new bootstrap.Tab(tabElement);
                lastTab.show();
            });
        });

        prevBtn.forEach(function(item, index){
            item.addEventListener('click', function(){
                let id = index;
                let tabElement = document.querySelectorAll("#myTabContent a")[id];
                var lastTab = new bootstrap.Tab(tabElement);
                lastTab.show();
            });
        });
    </script>
@endsection
