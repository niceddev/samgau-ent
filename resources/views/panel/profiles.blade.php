<table class="mt-12 border-collapse table-auto w-full text-sm">
    <thead>
        <tr>
            <th class="border-b font-medium p-4 pl-8 pt-0 pb-3 text-dark-400">{{ __('common.image') }}</th>
            <th class="border-b font-medium p-4 pr-8 pt-0 pb-3 text-dark-400">{{ __('common.name') }}</th>
        </tr>
    </thead>
    <tbody class="bg-white">
        @foreach($profiles as $profile)
            <tr>
                <td class="border-b border-slate-100 p-4 pl-8 text-slate-500">
                    <img class="max-h-36" style="object-fit: contain"
                         src="{{ asset($profile->image_path) }}" alt="" />
                </td>
                <td class="border-b border-slate-100 p-4 text-slate-500">
                    {{ $profile->name }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
