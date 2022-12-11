<?php

namespace App\Orchid\Screens\Subjects;

use App\Models\Subject;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CreateScreen extends AbstractMultiLanguageScreen
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
        return __('common.create') . ' ' . __('common.subject');
    }

    /**
     * Multi translatable fields
     *
     * @return array
     */
    protected function multiLanguageFields(): array
    {
        return [
            Input::make('subject.name')
                ->placeholder(__('common.example') . ' (Химия, Биология, Математика)')
                ->title('Введите название ' . __('common.subject') . 'а')
                ->required(),
        ];
    }

    /**
     * Not translatable fields
     *
     * @return array
     */
    protected function singleLanguageFields(): array
    {
        return [
            Layout::rows([
                Input::make('subject.color')
                    ->type('color')
                    ->title('common.bg_color'),
                Picture::make('subject.image_path')
                    ->storage('public')
                    ->targetUrl()
                    ->title(__('common.image')),
            ])
        ];
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
                ->href(route('platform.subjects.index')),
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
        Subject::create($request->input('subject'));

        Alert::info('['.$request->input('subject.name')['ru'] .'] Создано!');

        return redirect()->route('platform.subjects.index');
    }

}
