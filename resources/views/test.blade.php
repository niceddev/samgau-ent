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
                             role="tabpanel" aria-labelledby="nav-subject-{{ $subject->id }}-tab">
                            <ul id="questionNumbersTab" class="d-flex flex-column align-items-center gap-2 fs-3" role="tablist">
                                @foreach($subject->questions->where('grade_number', auth()->user()->grade_number) as $question)
                                    <div class="position-relative">
                                        <span class="position-absolute text-end">
                                            <p>{{ $loop->iteration }}</p>
                                        </span>
                                        <button id="{{ $question->id }}-tab" type="button" role="tab"
                                                class="@if($loop->first) active @endif"
                                                aria-controls="question-{{ $question->id }}"
                                                data-bs-toggle="tab" data-bs-target="#question-{{ $question->id }}"
                                        >
                                        </button>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </section>

            </div>

            <div id="questionContentSection" class="col-10 px-5">

                <div class="row text-center">
                    <ul id="subjectsTab" class="d-flex gap-5 fs-5" role="tablist">
                        @foreach($subjects as $subject)
                            <div style="width: 120px;" role="presentation">
                                <button id="nav-subject-{{ $subject->id }}-tab" type="button" role="tab"
                                        @if($loop->first) class="active" @endif
                                        data-bs-toggle="tab" data-bs-target="#nav-subject-{{ $subject->id }}"
                                        data-target="subject-{{ $subject->id }}-questions-content">
                                    <img class="img-fluid" src="{{ asset($subject->image_path) }}" alt="">
                                </button>
                                <p class="mt-2">{{ $subject->name }}</p>
                            </div>
                        @endforeach
                    </ul>
                </div>

                <form action="{{ route('test.finish') }}" method="POST">
                    @csrf
                    <input type="text" class="visually-hidden" name="subjects" value="{{ $subjects->pluck('id') }}">
                    <input id="timer" type="text" class="" name="timer">
                    <div class="row tab-content">
                        @foreach($subjects as $subject)
                            <div id="nav-subject-{{ $subject->id }}"
                                     class="tab-content tab-pane subject-{{ $subject->id }}-questions-content fade @if($loop->first)show active @endif"
                                     role="tabpanel" aria-labelledby="nav-subject-{{ $subject->id }}-tab"
                                     data-content="subject-{{ $subject->id }}-questions-content">
                                @foreach($subject->questions->where('grade_number', auth()->user()->grade_number) as $question)
                                    <div id="question-{{ $question->id }}"
                                         class="tab-pane fade @if($loop->first)show active @endif"
                                         role="tabpanel" aria-labelledby="{{ $subject->id }}-tab">

                                        <div class="row pt-3">
                                            <h2>{{ __('common.question') . ': '. $question->question }}</h2>
                                            <div class="my-4">
                                                {!! $question->sub_question !!}
                                            </div>
                                        </div>

                                        <div class="row">
                                            <h2>
                                                {{ __('common.variants') }}:
                                                @if($question->options->pluck('is_correct')->filter(fn($value) => $value)->count() !== 1)
                                                    <span class="fs-6 m-2 align-middle text-black-50">(правильных ответов несколько)</span>
                                                @endif
                                            </h2>
                                            <ul class="options">
                                                @foreach($question->optionsForTest as $key => $option)
                                                    <label>
                                                        <input id="option-{{ $option->id }}" name="subject-{{$subject->id}}[questions-{{ $question->id }}][]"
                                                               data-question="question-{{ $question->id }}"
                                                               @if($question->options->pluck('is_correct')->filter(fn($value) => $value)->count() === 1)
                                                                   type="radio"
                                                               @else
                                                                   type="checkbox"
                                                               @endif
                                                               value="{{ $option->getTranslation('option', session()->get('lang', 'ru')) }}">
                                                        <span class="option-checkmark">
                                                            {{ chr($key + 65) }}
                                                        </span>
                                                        <span class="option-text">
                                                            {{ $option->getTranslation('option', session()->get('lang', 'ru')) }}
                                                        </span>
                                                    </label>
                                                @endforeach
                                            </ul>
                                        </div>

                                        <div class="row next-question float-end text-center control-section-{{ $subject->id }}">
                                            <p>
                                                <span class="answered-questions-count">0</span>/<span>{{ $subject->questionsByGrade->count() }}</span>
                                            </p>
                                            <button type="button" class="answered-questions-button finish-button">
                                                {{ __('common.next_question') }}
                                            </button>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    @push('custom-scripts')
        <script src="{{ asset('js/test-page.js') }}"></script>
    @endpush

@endsection



