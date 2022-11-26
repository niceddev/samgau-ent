@extends('layouts.app')

@section('title')
    Тест
@endsection()

@section('content')
    <div id="container">
        <div class="row">
            <div class="col-sm-2" id="steps">
                <h3>ТЕСТ</h3>
                <span class="active_text">Активен</span>
                <h4 class="active_text">7/15</h4>
                <ol>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                    <li>A</li>
                    <li>B</li>
                    <li>C</li>
                </ol>
            </div>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-sm-2 subject_option_parent">
                        <div class="subject_option" id="physics_option">
                        </div>
                        <h4>Физика</h4>
                    </div>
                    <div class="col-sm-2 subject_option_parent">
                        <div class="subject_option" id="physics_option">
                        </div>
                        <h4>Физика</h4>
                    </div>
                    <div class="col-sm-2 subject_option_parent">
                        <div class="subject_option" id="physics_option">
                        </div>
                        <h4>Физика</h4>
                    </div>
                    <div class="col-sm-2 subject_option_parent">
                        <div class="subject_option" id="physics_option">
                        </div>
                        <h4>Физика</h4>
                    </div>
                    <div class="col-sm-2 subject_option_parent active_option">
                        <div class="subject_option" id="physics_option">
                        </div>
                        <h4>Физика</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
