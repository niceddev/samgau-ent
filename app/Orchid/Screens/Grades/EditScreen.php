<?php

namespace App\Orchid\Screens\Grades;

use App\Models\Grade;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
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
    public function query(Grade $grade): iterable
    {
        return [
            'grade' => $grade->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.grade');
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Grade $grade, Request $request)
    {
        $grade->update($request->input('grade'));

        Toast::info('Успешно сохранено!');

        return redirect()->route('platform.grades.index');
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Grade $grade)
    {
        $grade->delete();

        Toast::info('Удалено!');

        return redirect()->route('platform.grades.index');
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
                ->href(route('platform.grades.index')),
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
                Input::make('grade.name')
                    ->placeholder(__('common.example') . ' (11Б, 10А, 9В)')
                    ->title('Введите название ' . __('common.grade') . 'а')
                    ->required(),
            ])
        ];
    }
}
