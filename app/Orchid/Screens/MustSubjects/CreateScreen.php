<?php

namespace App\Orchid\Screens\MustSubjects;

use App\Models\MustSubject;
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
        return __('common.create') . ' ' . __('common.must_subject');
    }

    /**
     * Multi translatable fields
     *
     * @return array
     */
    protected function multiLanguageFields(): array
    {
        return [
            Input::make('must_subject.name')
                ->placeholder(__('common.example') . ' (Химия, Биология, Математика)')
                ->title('Введите название ' . __('common.must_subject') . 'а')
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
                Picture::make('must_subject.image_path')
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
                ->href(route('platform.must_subjects.index')),
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
        MustSubject::create($request->input('must_subject'));

        Alert::info('['.$request->input('must_subject.name')['ru'] .'] Создано!');

        return redirect()->route('platform.must_subjects.index');
    }

}
