<?php

namespace App\Orchid\Screens\Subjects;

use App\Models\Subject;
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
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Subject $subject, Request $request)
    {
        $subject->update($request->input('subject'));

        Toast::info('Успешно сохранено!');

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

        Toast::info('Удалено!');

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

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Picture::make('subject.image_path')
                    ->storage('public')
                    ->targetUrl()
                    ->title(__('common.image')),
                Input::make('subject.name')
                    ->placeholder(__('common.example') . ' (Химия, Биология, Математика)')
                    ->title('Введите название ' . __('common.subject') . 'а')
                    ->required(),
            ])
        ];
    }
}
