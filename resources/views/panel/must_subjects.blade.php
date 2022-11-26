@if($mustSubjects->isEmpty())
    <h1 class="mt-5 text-5xl text-center font-extrabold tracking-tight leading-none text-gray-300 md:text-5xl lg:text-6xl">
        Пусто
    </h1>
@else
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
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
                <table id="{{ $key }}" role="tabpanel" class="{{ $key != app()->getLocale() ? 'hidden' : 'active' }} border-collapse table-auto w-full text-sm">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th class="border-b font-medium p-4 pl-8 pb-3 text-dark-400">{{ __('common.image') }}</th>
                            <th class="border-b font-medium p-4 pr-8 pb-3 text-dark-400">{{ __('common.name') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        @foreach($mustSubjects as $mustSubject)
                            <tr>
                                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                                    <img class="max-h-36" style="object-fit: contain"
                                         src="{{ asset($mustSubject->image_path) }}" alt="" />
                                </td>
                                <td class="border-b border-slate-100 p-4 text-slate-500">
                                    {{ $mustSubject->getTranslation('name', $key) }}
                                </td>
                                <td class="border-b border-slate-100 p-4 text-slate-500 text-right">
                                    <a href="{{ route('platform.must_subjects.edit', $mustSubject->id) }}" class="hover:bg-gray-300 text-white bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                        {{ __('common.edit') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </div>
@endif

<link rel="stylesheet" href="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.min.css"/>
<script src="https://unpkg.com/@themesberg/flowbite@1.2.0/dist/flowbite.bundle.js"></script>
