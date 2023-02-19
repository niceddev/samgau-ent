@extends('layouts.app')

@section('title')
    {{ __('common.fix_mistakes') }}
@endsection()

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">

            <div class="col-4">
                <div class="d-flex align-items-start">
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
                    @foreach($subjects as $subject)
                        <div id="nav-subject-{{ $subject->id }}"
                             class="tab-content tab-pane subject-{{ $subject->id }}-questions-content fade @if($loop->first)show active @endif"
                             role="tabpanel" aria-labelledby="nav-subject-{{ $subject->id }}-tab"
                             data-content="subject-{{ $subject->id }}-questions-content">

                            {{ $subject->id }}

                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>

@endsection



