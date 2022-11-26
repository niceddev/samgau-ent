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
                <div class="subject-card">
                    <div class="big violet">
                        <div id="math_knowledge" class="subject"></div>
                    </div>
                    <div class="checksign"></div>
                    <div class="main_subject_label">
                        <h4>Математическая грамотность</h4>
                    </div>
                </div>

                <div class="subject-card">
                    <div class="big blue">
                        <div id="reading" class="subject"></div>
                    </div>
                    <div class="checksign"></div>
                    <div class="main_subject_label">
                        <h4>Грамотность чтения</h4>
                    </div>
                </div>
                <div class="subject-card">
                    <div class="big yellow">
                        <div id="kz_history" class="subject"></div>
                    </div>
                    <div class="checksign"></div>
                    <div class="main_subject_label">
                        <h4>История Казахстана</h4>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h4>
                    Предметы по профилю
                </h4>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subject-card">
                            <div class="small pink">
                                <div id="biology" class="subject"></div>
                            </div>
                            <div class="profile_subject_label">
                                <h4>Биология</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
