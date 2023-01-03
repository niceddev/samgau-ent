<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Grade;
use App\Models\Question;
use App\Models\Subject;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class QuestionsScreen extends Screen
{
    private Object $subject;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(int $id): iterable
    {
        $subjects = Subject::get();

        $this->subject = $subjects->filter(function($item) use($id) {
            return $item->id == $id;
        })->first();

        return [
            'subject'   => $this->subject->toArray(),
            'grades'    => Grade::get(),
            'questions' => Question::where('subject_id', $this->subject->id)->get(),
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.questions') . ': ' . $this->subject->name;
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make(__('common.add_question'))
                ->modal('createQuestion')
                ->method('create'),
        ];
    }

    /**
     * Create method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request): void
    {
        dd($request);
        $question = Question::create($request->validated());

        Alert::info('Вопрос создан!');
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('panel.questions'),
            Layout::modal('createQuestion', Layout::rows([

                Input::make('question')->title('Вопрос')->required(),
                Quill::make('sub_question')->title('Дополнение'),
                Group::make([
                    Input::make('option[]')->title('Вариант A:')->required(),
                    CheckBox::make('is_correct[]')->title('Правильный ответ')
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант B:')->required(),
                    CheckBox::make('is_correct[]')->title('Правильный ответ')
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант C:')->required(),
                    CheckBox::make('is_correct[]')->title('Правильный ответ')
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант D:')->required(),
                    CheckBox::make('is_correct[]')->title('Правильный ответ')
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант E:')->required(),
                    CheckBox::make('is_correct[]')->title('Правильный ответ')
                ]),
                Select::make('grade_id')
                    ->fromModel(Grade::class, 'name')
                    ->empty('No select')
                    ->title('Выберите класс'),
                Input::make('subject_id')
                    ->value($this->subject->id)
                    ->hidden(),
            ]))
                ->size(Modal::SIZE_LG)
                ->title('Создание вопроса')
                ->applyButton(__('common.create')),
        ];
    }
}
