<table class="mt-12 border-collapse table-auto w-full text-sm">
    <thead>
    <tr>
        <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-dark-400">E-mail</th>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.fio') }}</th>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.grade') }}</th>
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
        </tr>
    @endforeach
    </tbody>
</table>
