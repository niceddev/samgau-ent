@extends('layouts.app')

@section('title')
    {{ __('common.fix_mistakes') }}
@endsection()

@section('content')
    <div class="container my-5" id="work-on-mistakes">
        <div class="row justify-content-center">

            <div class="col-3">
                <div class="d-flex">
                    <div class="nav flex-column nav-pills me-3" id="subjectsTab" style="border-bottom: 0" role="tablist" aria-orientation="vertical">
                        @foreach($subjects as $subject)
                            <div class="text-center mb-3">
                                <button id="nav-subject-{{ $subject->id }}-tab" type="button" role="tab"
                                        @if($loop->first) class="active" @endif
                                        data-bs-toggle="tab" data-bs-target="#nav-subject-{{ $subject->id }}"
                                        data-target="subject-{{ $subject->id }}-questions-content">
                                    <img class="img-fluid" src="{{ asset($subject->image_path) }}" alt="">
                                </button>
                                <p class="mt-2 text-center" style="max-width: 200px">{{ $subject->name }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
            <div class="col-4">
                <div class="tab-content" id="v-pills-tabContent">
                    <h2 class="text-center mb-4">{{ __('common.questions') }}</h2>
                    @foreach($subjects as $subject)
                        <div id="nav-subject-{{ $subject->id }}"
                             class="tab-content tab-pane subject-{{ $subject->id }}-questions-content fade @if($loop->first)show active @endif"
                             role="tabpanel" aria-labelledby="nav-subject-{{ $subject->id }}-tab"
                             data-content="subject-{{ $subject->id }}-questions-content">
                            <ul>
                                @foreach($subject->questions->whereIn('id', explode(',', $questionIds['subject-' . $subject->id][0] ?? '') ?? []) as $question)

                                    <li class="list-unstyled d-flex">
                                        <p class="question-nums">{{ $question->id }}</p>
                                        <ul class="list-group list-group-horizontal">
                                            @foreach($question->load('optionsForTest')->optionsForTest as $option)
                                                <li class="list-unstyled
                                                    @foreach($answersOptions->collapse()->where('question_id', $question->id) as $answerOption)
                                                        @if($option->id === $answerOption->id && $answerOption->is_correct)
                                                            option-correct
                                                        @elseif($option->id === $answerOption->id && !$answerOption->is_correct)
                                                            option-wrong
                                                        @endif
                                                    @endforeach
                                                    option-item">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>

                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                    <div class="d-flex">
                        <a class="btn" href="{{ route('test.index', ['subjects' => $subjects->pluck('id')->toArray(), 'questionIds' => $questionIds]) }}">
                            {{ __('common.repeat_test') }}
                        </a>

                        <a class="btn" href="{{ route('cabinet.index') }}">
                            {{ __('common.cabinet') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <script src="{{ asset('js/bootstrap.js') }}"></script>

@endsection



