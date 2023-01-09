@extends('layouts.app')

@section('title')
    {{ __('common.sign_up') }}
@endsection()

@section('content')
    <div id="register" class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        @if($errors->any())
            @foreach ($errors->all() as $error)
                <p class="text-danger fs-5">{{ $error }}</p>
            @endforeach
        @endif
        <div class="bg-white container rounded-5 p-0" style="width: 620px;">
            <form action="{{ route('register.store') }}" method="POST" class="position-relative">
                <div id="lang_switcher" class="row px-3" style="font-size: 24px">
                    <div>
                        @foreach(config('app.languages') as $key => $lang)
                            <a href="#" onclick="changeLanguage(this.dataset)" class="{{ session()->get('lang') === $key ? 'active_lang' : '' }}"
                               {{ session()->has('lang') ? (session()->get('lang') === $key ? 'selected' : '') : '' }}
                               data-value="{{ $key }}">
                                {{ $lang }}
                            </a>
                        @endforeach
                    </div>
                </div>
                @csrf
                <div class="row px-5 py-3">
                    <div class="px-0 d-flex justify-content-between align-items-center">
                        <a class="fw-bold" style="text-decoration:none;color: #2F327D; font-size: 40px;">
                            {{ mb_strtoupper(__('common.sign_up')) }}
                        </a>
                        <a href="{{ route('login.form') }}" class="fw-bold" style="text-decoration:none;color:#2F327D;font-size:25px;">
                            {{ mb_strtoupper(__('common.sign_in')) }}
                        </a>
                    </div>
                </div>

                <div class="row px-5">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="fio" class="custom-label">{{ __('common.fio') }}:</label>
                    </div>
                    <input id="fio" name="fio"
                           value="{{ old('fio') }}"
                           class="custom-input border-0 rounded-3" type="text" required placeholder="{{ __('common.fio') }}">
                </div>

                <div class="row px-5 mt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="email" class="custom-label">Email:</label>
                    </div>
                    <input id="email" name="email"
                           value="{{ old('email') }}"
                           class="custom-input border-0 rounded-3" type="email" required placeholder="{{ __('common.enter_email') }}">
                </div>

                <div class="row px-5 mt-3">
                    <label for="password" class="custom-label">{{ __('common.password') }}:</label>
                    <input id="password" name="password"
                           class="custom-input border-0 rounded-3" type="password" required placeholder="{{ __('common.enter_password') }}">
                </div>

                <div class="row px-5 mt-3">
                    <label for="confirm-password" class="custom-label">{{ __('common.password_confirmation') }}:</label>
                    <input id="confirm-password" name="password_confirmation"
                           class="custom-input border-0 rounded-3" type="password" required placeholder="{{ __('common.password_confirmation') }}">
                </div>

                <div class="row px-5 mt-3">
                    <label for="select-school" class="custom-label">{{ __('common.school') }}:</label>
                    <select id="select-school" class="custom-input border-0 rounded-3"
                            name="school" required>
                        <option disabled selected value="">{{ __('common.select_school') }}</option>
                        @foreach($regions as $region)
                            <option disabled>{{ $region->title }}</option>
                            @foreach($region->schools()->get() as $school)
                                <option value="{{ $school->id }}">{{ $school->title }}</option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="row px-5 mt-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <label for="gradeId" class="custom-label">{{ __('common.grade') }}:</label>
                    </div>
                    <div class="d-flex gap-2 p-0">
                        <input id="gradeId" class="col-10 custom-input border-0 rounded-3"
                               name="grade_number" required
                               value="{{ old('grade_number') }}"
                               type="number" max="11" min="5"
                               placeholder="{{ __('common.grade') }}">
                        <select id="select-school" class="col-2 custom-input border-0 rounded-3"
                                name="grade_letter" required>
                            <option disabled selected></option>
                            @foreach(config('app.kazakh_alphabet') as $letter)
                                <option value="{{ $letter }}" {{ old('grade_letter') === $letter ? 'selected' : ''}}>{{ $letter }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mt-5">
                    <button type="submit" class="login-btn text-white fs-2 p-4 w-50 mx-auto rounded-3 border-0">
                        {{ __('common.sign_up') }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        function changeLanguage(data){
            window.location='{{ url('change-lang') }}/' + data.value;
        }
    </script>
@endsection
