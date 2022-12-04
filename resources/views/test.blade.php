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
                <ol class="nav nav-tabs" id="myTab" role="tablist">
                    @foreach($questions as $question)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                        </li>
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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">...</div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.js') }}"></script>
@endsection
