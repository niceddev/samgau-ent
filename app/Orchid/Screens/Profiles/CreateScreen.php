<?php

namespace App\Orchid\Screens\Profiles;

use App\Models\Profile;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class CreateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.create') . ' ' . __('common.profile');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Cancel'))
                ->href(route('platform.profiles.index')),
            Button::make(__('Save'))
                ->method('save'),
        ];
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        Profile::create($request->input('profile'));

        Toast::info('Успешно сохранено!');

        return redirect()->route('platform.profiles.index');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Picture::make('profile.image_path')
                    ->storage('public')
                    ->targetUrl()
                    ->title(__('common.image')),
                Input::make('profile.name')
                    ->placeholder(__('common.example') . ' (Химия, Биология, Математика)')
                    ->title('Введите название ' . __('common.profile') . 'а')
                    ->required(),
            ])
        ];
    }
}
