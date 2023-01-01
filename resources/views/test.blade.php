@extends('layouts.app')

@section('title')
    Тест
@endsection()

@section('content')
    <div class="container my-5">
        <div class="row">

            <div id="questionNumbersSection" class="col-2 p-0 text-center">

                <h1>ТЕСТ</h1>
                <p style="line-height:0;color:#5beb7b">активен</p>
{{--                    @foreach() --}}
                    <div class="question-content">
                        <ul id="questionNumbersTab" class="d-flex flex-column align-items-center gap-2 fs-3" role="tablist">
                            @foreach($questions as $question)
                                <div class="position-relative">
                                    <span class="position-absolute text-end">
                                        <p>{{ $loop->iteration }}</p>
                                    </span>
                                    <button id="{{ $question->id }}-tab" type="button" role="tab"
                                            class="@if($loop->first) active @endif"
                                            aria-controls="tab-{{ $question->id }}" aria-selected="false"
                                            data-bs-toggle="tab" data-bs-target="#tab-{{ $question->id }}"
                                    ></button>
                                </div>
                            @endforeach
                        </ul>
                    </div>
{{--                    @endforeach--}}

            </div>

            <div id="questionContentSection" class="col-10 px-5">

                <div class="row text-center">
                    <ul id="subjectsTab" class="d-flex gap-5 fs-5" role="tablist">
                        @foreach($subjects as $subject)
                            <div style="width: 120px;" role="presentation">
                                <button id="subject-{{ $subject->id }}-tab" type="button" role="tab">
                                    <img class="img-fluid" src="{{ asset($subject->image_path) }}" alt="">
                                </button>
                                <p class="mt-2">{{ $subject->name }}</p>
                            </div>
                        @endforeach
                    </ul>
                </div>

                <div class="row">
{{--                    @foreach($questions as $question)--}}
                        <div class="question-content">

                            <div class="row">
                                <h2>{{ __('common.question') . ': '. $question->question }}</h2>
                                <div class="my-4">
                                    {!! $question->sub_question !!}
                                </div>
                            </div>

                            <div class="row">
                                <h2>{{ __('common.variants') }}:</h2>
                                <ul class="options">
                                    @foreach([1,2,3,4,5] as $option)
                                        <li>
                                            {{ $option }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="row next-question float-end text-center">
                                <p>
                                    <span>0</span>/<span>{{ $questions->count() }}</span>
                                </p>
                                <button>
                                    {{ __('common.next_question') }}
                                </button>
                            </div>

                        </div>
{{--                    @endforeach--}}
                </div>

            </div>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @push('custom-scripts')
        <script src="{{ asset('js/test-page.js') }}"></script>
    @endpush

@endsection


{{--                    <nav>--}}
{{--                        <div class="nav nav-tabs" id="nav-tab" role="tablist">--}}
{{--                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"--}}
{{--                                data-target="f1">--}}
{{--                                Home--}}
{{--                            </button>--}}
{{--                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"--}}
{{--                                data-target="s1">--}}
{{--                                Profile--}}
{{--                            </button>--}}
{{--                        </div>--}}
{{--                    </nav>--}}

{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane f fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">F</div>--}}
{{--                        <div class="tab-pane s fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">S</div>--}}
{{--                    </div>--}}

{{--                    <div class="tab-content">--}}
{{--                        <div class="tab-pane f1 fade show active" data-content="f1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">F1</div>--}}
{{--                        <div class="tab-pane s1 fade" data-content="s1" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">S1</div>--}}
{{--                    </div>--}}
