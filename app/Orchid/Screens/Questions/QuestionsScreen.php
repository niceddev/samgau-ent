<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Grade;
use App\Models\Option;
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
        foreach(['a', 'b', 'c', 'd', 'e'] as $abc){
            $optionStatuses[] = $request->input('is_correct_' . $abc);
        }

        $options = array_map(function ($option, $key) use ($optionStatuses) {
            return [
                'option' => $option,
                'is_correct' => $optionStatuses[$key]
            ];
        },
            $request->input('option'),
            array_keys($request->input('option')));

        $question = Question::create([
            'question'     => $request->input('question'),
            'sub_question' => $request->input('sub_question'),
            'grade_id'     => $request->input('grade_id'),
            'subject_id'   => $request->input('subject_id'),
        ]);

        foreach ($options as $option){
            Option::create([
                'option'      => $option['option'],
                'question_id' => $question->id,
                'is_correct'  => $option['is_correct'],
            ]);
        }

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
                    CheckBox::make('is_correct_a')->title('Правильный ответ')->sendTrueOrFalse()
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант B:')->required(),
                    CheckBox::make('is_correct_b')->title('Правильный ответ')->sendTrueOrFalse()
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант C:')->required(),
                    CheckBox::make('is_correct_c')->title('Правильный ответ')->sendTrueOrFalse()
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант D:')->required(),
                    CheckBox::make('is_correct_d')->title('Правильный ответ')->sendTrueOrFalse()
                ]),
                Group::make([
                    Input::make('option[]')->title('Вариант E:')->required(),
                    CheckBox::make('is_correct_e')->title('Правильный ответ')->sendTrueOrFalse()
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
