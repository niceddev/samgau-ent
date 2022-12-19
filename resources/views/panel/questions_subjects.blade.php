@if($subjects->isEmpty())
    <h1 class="mt-5 text-5xl text-center font-extrabold tracking-tight leading-none text-gray-300 md:text-5xl lg:text-6xl">
        Пусто
    </h1>
@else
    <div class="overflow-x-auto relative">
        <ul id="tab" class="flex flex-wrap -mb-px text-sm font-medium text-center" data-tabs-toggle="#tabContent" role="tablist">
            @foreach(config('app.languages') as $key => $lang)
                <li class="mr-2">
                    <button class="inline-block p-4 rounded-t-lg border-b-2 {{ $key != app()->getLocale() ? '' : 'active' }} " type="button" role="tab"
                            data-tabs-target="#{{$key}}"
                            aria-selected="{{ $key != app()->getLocale() ? 'false' : 'true' }}">
                        {{ $lang }}
                    </button>
                </li>
            @endforeach
        </ul>
        <div id="tabContent" id="{{ $key }}">
            @foreach(config('app.languages') as $key => $lang)

                <aside id="{{ $key }}" role="tabpanel" aria-label="" style="background-color: #edeef0"
                       class="{{ $key != app()->getLocale() ? 'hidden' : 'active' }} py-8 bg-gray-50">
                    <div class="mx-auto max-w-screen-xl">
                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                            @foreach($subjects as $subject)
                                <article class="bg-white p-4 rounded-lg max-w-xs text-center justify-items-center grid overflow-hidden">
                                    <div class="p-3 rounded mb-3" style="background-color: {{ $subject->color }}">
                                        <img src="{{ asset($subject->image_path) }}" class="mb-3 rounded-lg" alt="Image 1" style="max-height: 92px">
                                    </div>
                                    <h2 class="fs-4 font-bold leading-tight break-words text-gray-900">
                                        {{ $subject->getTranslation('name', $key) }}
                                    </h2>
                                    <a href="{{ route('platform.questions.index', $subject->id) }}"
                                       class="mt-3 content-center grid text-white bg-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 py-2.5">
                                        {{ __('common.add_question') }}
                                    </a>
                                </article>
                            @endforeach
                        </div>
                    </div>
                </aside>

            @endforeach
        </div>
    </div>
@endif

<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css"/>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
