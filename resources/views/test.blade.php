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
                <section class="tab-content">
                    @foreach($subjects as $subject)
                        <div id="nav-subject-{{ $subject->id }}"
                             class="tab-pane fade @if($loop->first)show active @endif"
                             role="tabpanel" aria-labelledby="nav-subject-{{ $subject->id }}-tab"
                        >
                            <ul id="questionNumbersTab" class="d-flex flex-column align-items-center gap-2 fs-3" role="tablist">
                                @foreach($subject->questions as $question)
                                    <div class="position-relative">
                                        <span class="position-absolute text-end">
                                            <p>{{ $loop->iteration }}</p>
                                        </span>
                                        <button id="{{ $question->id }}-tab" type="button" role="tab"
                                                class="@if($loop->first) active @endif"
                                                aria-controls="tab-{{ $question->id }}"
    {{--                                            data-bs-toggle="tab" data-bs-target="#tab-{{ $question->id }}"--}}
                                        ></button>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </section>

            </div>

            <div id="questionContentSection" class="col-10 px-5">

                <div class="row text-center">
                    <ul id="subjectsTab" class="nav nav-tabs d-flex gap-5 fs-5" role="tablist">
                        @foreach($subjects as $subject)
                            <div style="width: 120px;" role="presentation">
                                <button id="nav-subject-{{ $subject->id }}-tab" type="button" role="tab"
                                        @if($loop->first) class="active" @endif
                                        data-bs-toggle="tab" data-bs-target="#nav-subject-{{ $subject->id }}"
                                        data-target="subject-{{ $subject->id }}-questions-content"
                                >
                                    <img class="img-fluid" src="{{ asset($subject->image_path) }}" alt="">
                                </button>
                                <p class="mt-2">{{ $subject->name }}</p>
                            </div>
                        @endforeach
                    </ul>
                </div>

                                    <nav>
                                        <div class="nav nav-tabs" role="tablist">
                                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab"
                                                data-target="f1">
                                                Home
                                            </button>
                                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab"
                                                data-target="s1">
                                                Profile
                                            </button>
                                        </div>
                                    </nav>

                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >F</div>
                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">S</div>
                                    </div>

                                    <div class="tab-content">
                                        <div class="tab-pane f1 fade show active" data-content="f1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" >F1</div>
                                        <div class="tab-pane s1 fade" data-content="s1" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" >S1</div>
                                    </div>


                <div class="row">
{{--                    @foreach($subject->questions as $question)--}}
                        <section>

                            <div class="row pt-3">
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
                                    <span>0</span>/<span>{{ $subject->questions->count() }}</span>
                                </p>
                                <button>
                                    {{ __('common.next_question') }}
                                </button>
                            </div>

                        </section>
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



