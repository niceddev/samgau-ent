<?php

namespace App\Orchid\Screens\Profiles;

use App\Models\Profile;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class EditScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(Profile $profile): iterable
    {
        return [
            'profile' => $profile->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.profile');
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Profile $profile, Request $request)
    {
        $profile->update($request->input('profile'));

        Toast::info('Успешно сохранено!');

        return redirect()->route('platform.profiles.index');
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Profile $profile)
    {
        $profile->delete();

        Toast::info('Удалено!');

        return redirect()->route('platform.profiles.index');
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make(__('Remove'))
                ->method('remove'),
            Link::make(__('Cancel'))
                ->href(route('platform.profiles.index')),
            Button::make(__('Save'))
                ->method('save'),
        ];
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
                    ->title('Введите название ' . rtrim(__('common.profile'), 'ь') . 'я')
                    ->required(),
            ])
        ];
    }
}
