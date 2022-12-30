@extends('layouts.app')

@section('title')
    Тест
@endsection()

@section('content')
    <div class="container text-center mt-5">
        <div class="row">

            <div id="questionNumbersSection" class="col-2 p-0">
                <h1>ТЕСТ</h1>
                <p style="line-height:0;color:#5beb7b">активен</p>
                <ul id="questionNumbersTab" class="d-flex flex-column align-items-center gap-3 fs-3" role="tablist">
                    @foreach($questions as $question)
                        <div class="position-relative">
                            <span class="position-absolute text-end">
                                <p>{{ $loop->iteration }}</p>
                            </span>
                            <button id="{{ $question->id }}-tab" type="button" role="tab"
{{--                                class="@if($loop->first) active @endif"--}}
{{--                                aria-controls="tab-{{ $question->id }}" aria-selected="false"--}}
{{--                                data-bs-toggle="tab" data-bs-target="#tab-{{ $question->id }}"--}}
                            ></button>
                        </div>
                    @endforeach
                </ul>
            </div>
            <div id="questionContentSection" class="col-10 px-5">
                <div class="row">
                    <ul id="subjectsTab" class="d-flex gap-5 fs-5" role="tablist">
                        @foreach($subjects as $subject)
                            <div style="width: 120px;" role="presentation">
                                <button id="subject-{{ $subject->id }}-tab" type="button" role="tab"
                                    class=""
                                >
                                    <img class="img-fluid" src="{{ asset($subject->image_path) }}" alt="">
                                </button>
                                <p class="mt-2 text-break">{{ $subject->name }}</p>
                            </div>
                        @endforeach
                    </ul>
                </div>
                <div class="row">


                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                                data-target="f1">
                                Home
                            </button>
                            <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false"
                                data-target="s1">
                                Profile
                            </button>
                        </div>
                    </nav>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane f fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">F</div>
                        <div class="tab-pane s fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">S</div>
                    </div>

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane f1 fade show active" data-content="f1" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">F1</div>
                        <div class="tab-pane s1 fade" data-content="s1" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">S1</div>
                    </div>



                </div>
            </div>

        </div>
    </div>


{{--    <div id="container" class="test-page">--}}
{{--        <div class="row">--}}
{{--            <div class="col-sm-10">--}}
{{--                <div class="row">--}}
{{--                    <div style="min-height: 120px;" class="overflow-hidden">--}}
{{--                        <div class="grid main" id="subjects">--}}
{{--                            <div class="items">--}}
{{--                                @foreach($subjects as $subject)--}}
{{--                                    <div class="item col-sm-2">--}}
{{--                                        <img src="{{ asset($subject->image_path) }}" alt="">--}}
{{--                                        <h4>{{ $subject->name }}</h4>--}}
{{--                                    </div>--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="row">--}}
{{--                    <div class="tab-content" id="myTabContent">--}}
{{--                        @foreach($questions as $question)--}}
{{--                            <div class="tab-pane fade @if($loop->first) active show @endif" id="tab-{{ $question->id }}"--}}
{{--                                 role="tabpanel" aria-labelledby="{{ $question->id }}-tab" tabindex="0">--}}

{{--                                <p>{{ __('common.question') }}: {{ $question->question }}</p>--}}
{{--                                <p>{!! $question->sub_question !!}</p>--}}

{{--                                <ul>--}}
{{--                                    <li>{{ $question->option_a }}</li>--}}
{{--                                    <li>{{ $question->option_b }}</li>--}}
{{--                                    <li>{{ $question->option_c }}</li>--}}
{{--                                    <li>{{ $question->option_d }}</li>--}}
{{--                                    <li>{{ $question->option_e }}</li>--}}
{{--                                </ul>--}}

{{--                            </div>--}}
{{--                        @endforeach--}}

{{--                        <a class="btn btn-primary btnPrev">Back</a>--}}
{{--                        <a class="btn btn-primary btnNext">Next</a>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @push('custom-scripts')
        <script src="{{ asset('js/test-page.js') }}"></script>
    @endpush

@endsection
