<table class="mt-12 border-collapse table-auto w-full text-sm">
    <thead>
    <tr>
        <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-dark-400">E-mail</th>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.fio') }}</th>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.grade') }}</th>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400 float-end">{{ __('common.edit') }}</th>
    </tr>
    </thead>
    <tbody class="bg-white">
    @foreach($students as $student)
        <tr>
            <td class="border-b border-slate-100 p-4 text-slate-500">
                {{ $student->email }}
            </td>
            <td class="border-b border-slate-100 p-4 text-slate-500">
                {{ $student->fio }}
            </td>
            <td class="border-b border-slate-100 p-4 text-slate-500">
                {{ $student->grade->name ?? null }}
            </td>
            <td class="border-b border-slate-100 p-4 text-slate-500 text-right">
                <a href="{{ route('platform.students.edit', $student->id) }}" class="hover:bg-gray-300 text-white bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                    {{ __('common.edit') }}
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
