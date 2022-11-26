@extends('layouts.app')

@section('title')
    Предметы
@endsection()

@section('content')
    <div id="thin-container">
        <div id="lang_switcher">
            <a href="#" class="active_lang">KZ</a>
            <a href="#">RU</a>
        </div>
        <h3>Выберите специализацию и пройдите ЕНТ</h3>
    <!-- write  two columns sm-6 from bootstrap grid  -->
        <div class="row">
            <div class="col-sm-6">
                <h4 class="secondary">
                    Обязательные
                </h4>
                <div class="row">
                    @foreach($mustSubjects as $subject)
                        <div class="subject-card">
                            <div>
                                <img class="subject" src="{{ asset($subject->image_path) }}" alt="" >
                            </div>
                            <div class="checksign"></div>
                            <div class="main_subject_label">
                                <h4>{{ $subject->name }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-sm-6">
                <h4>
                    Предметы по профилю
                </h4>
                <div class="row">
                    @foreach($subjects as $subject)
                        <div class="col-sm-6">
                            <div class="subject-card">
                                <div class="small pink">
                                    <img class="subject" src="{{ asset($subject->image_path) }}" alt="" >
                                </div>
                                <div class="profile_subject_label">
                                    <h4>{{ $subject->name }}</h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
