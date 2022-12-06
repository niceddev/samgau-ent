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
                    <p>
                        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#subjects" aria-expanded="false" aria-controls="subjects">
                            Toggle width collapse
                        </button>
                    </p>
                    <div style="min-height: 120px;" class="overflow-hidden">
                        <div class="collapse collapse-horizontal grid main" id="subjects">
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
    <script>
        const slider = document.querySelector('.items');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = x - startX
            slider.scrollLeft = scrollLeft - walk;
        });
    </script>
@endsection
