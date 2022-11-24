<?php

namespace App\Orchid\Screens\Students;

use App\Models\Grade;
use App\Models\Student;
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
    public function query(Student $student): iterable
    {
        return [
            'student' => $student->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.student') . 'а';
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Student $student, Request $request)
    {
        $student->update($request->input('student'));

        Toast::info('Успешно сохранено!');

        return redirect()->route('platform.students.index');
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Student $student)
    {
        $student->delete();

        Toast::info('Удалено!');

        return redirect()->route('platform.students.index');
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
                ->href(route('platform.students.index')),
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
                Input::make('student.email')
                    ->placeholder('Введите E-mail')
                    ->title('E-mail')
                    ->required(),
                Input::make('student.password')
                    ->placeholder('Введите ' . __('Password'))
                    ->title(__('Password'))
                    ->required(),
                Input::make('student.fio')
                    ->placeholder('Введите ' . __('common.fio'))
                    ->title(__('common.fio'))
                    ->required(),
                Select::make('student.grade_id')
                    ->fromModel(Grade::class, 'name')
                    ->empty('No select')
                    ->title(__('common.grades'))
            ])
        ];
    }
}
