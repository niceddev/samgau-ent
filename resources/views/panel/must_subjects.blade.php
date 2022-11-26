<table class="mt-12 border-collapse table-auto w-full text-sm">
    <thead>
        <tr>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-dark-400">{{ __('common.image') }}</th>
            <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.name') }}</th>
            <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400 float-end">{{ __('common.edit') }}</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach($mustSubjects as $subject)
            <tr>
                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                    <img class="max-h-36" style="object-fit: contain"
                         src="{{ asset($subject->image_path) }}" alt="" />
                </td>
                <td class="border-b border-slate-100 p-4 text-slate-500">
                    {{ $subject->name }}
                </td>
                <td class="border-b border-slate-100 p-4 text-slate-500 text-right">
                    <a href="{{ route('platform.must_subjects.edit', $subject->id) }}" class="hover:bg-gray-300 text-white bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                        {{ __('common.edit') }}
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
