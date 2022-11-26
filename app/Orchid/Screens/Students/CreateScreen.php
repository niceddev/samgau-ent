<?php

namespace App\Orchid\Screens\Students;

use App\Models\Grade;
use App\Models\Student;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class CreateScreen extends Screen
{
    /**
     * Query data.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'grades' => Grade::get()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.create') . ' ' . __('common.student');
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
                ->href(route('platform.students.index')),
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
        Student::create($request->input('student'));

        Alert::info('['.$request->input('student.fio') .'] Создано!');

        return redirect()->route('platform.students.index');
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
