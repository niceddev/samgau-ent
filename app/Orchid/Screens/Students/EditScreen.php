<?php

namespace App\Orchid\Screens\Students;

use App\Models\School;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
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
        $student->update([
            'email'        => $request->input('student')['email'],
            'password'     => Hash::make($request->input('student')['password']),
            'fio'          => $request->input('student')['fio'],
            'school_id'    => $request->input('student')['school_id'],
            'grade_number' => $request->input('student')['grade_number'],
            'grade_letter' => $request->input('student')['grade_letter'],
        ]);

        Alert::message('[' . $request->input('student.fio') . '] Успешно сохранено!');

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

        Alert::error('[' . $student->fio . '] Удалено!');

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
                    ->type('password')
                    ->placeholder('Введите ' . __('Password'))
                    ->title(__('Password'))
                    ->required(),
                Input::make('student.fio')
                    ->placeholder('Введите ' . __('common.fio'))
                    ->title(__('common.fio'))
                    ->required(),
                Select::make('student.school_id')
                    ->fromModel(School::class, 'title')
                    ->empty('No select')
                    ->title(__('common.school')),
                Input::make('student.grade_number')
                    ->placeholder('Введите класс')
                    ->title(__('common.grades')),
                Input::make('student.grade_letter')
                    ->placeholder('Введите букву класса')
                    ->title('Буква')
            ])
        ];
    }
}
