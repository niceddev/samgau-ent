<?php

namespace App\Orchid\Screens\MustSubjects;

use App\Models\MustSubject;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class EditScreen extends AbstractMultiLanguageScreen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(MustSubject $mustSubject): iterable
    {
        return [
            'mustSubject' => $mustSubject->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.must_subject');
    }

    /**
     * Multi translatable fields
     *
     * @return array
     */
    protected function multiLanguageFields(): array
    {
        return [
            Input::make('mustSubject.name')
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
                Picture::make('mustSubject.image_path')
                    ->storage('public')
                    ->targetUrl()
                    ->title(__('common.image')),
            ])
        ];
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(MustSubject $mustSubject, Request $request)
    {
        $mustSubject->update($request->input('mustSubject'));

        Alert::message('['.$request->input('mustSubject.name').'] Успешно сохранено!');

        return redirect()->route('platform.must_subjects.index');
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(MustSubject $mustSubject)
    {
        $mustSubject->delete();

        Alert::error('['.$mustSubject->name.'] Удалено!');

        return redirect()->route('platform.must_subjects.index');
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
                ->href(route('platform.must_subjects.index')),
            Button::make(__('Save'))
                ->method('save'),
        ];
    }

}
