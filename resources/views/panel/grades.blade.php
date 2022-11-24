<table class="mt-12 border-collapse table-auto w-full text-sm">
    <thead>
    <tr>
        <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.name') }}</th>
    </tr>
    </thead>
    <tbody class="bg-white">
    @foreach($grades as $grade)
        <tr>
            <td class="border-b border-slate-100 p-4 text-slate-500">
                {{ $grade->name }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
