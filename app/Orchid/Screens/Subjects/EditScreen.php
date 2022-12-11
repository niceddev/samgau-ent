<?php

namespace App\Orchid\Screens\Subjects;

use App\Models\Subject;
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
    public function query(Subject $subject): iterable
    {
        return [
            'subject' => $subject->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.subject');
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
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Subject $subject, Request $request)
    {
        $subject->update($request->input('subject'));

        Alert::message('['.$request->input('subject.name')['ru'].'] Успешно сохранено!');

        return redirect()->route('platform.subjects.index');
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Subject $subject)
    {
        $subject->delete();

        Alert::error('['.$subject->name.'] Удалено!');

        return redirect()->route('platform.subjects.index');
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
                ->href(route('platform.subjects.index')),
            Button::make(__('Save'))
                ->method('save'),
        ];
    }

}
