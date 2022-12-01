<?php

namespace App\Orchid\Screens\Questions;

use App\Enums\AnswerOption;
use App\Http\Requests\Panel\QuestionsRequest;
use App\Models\Question;
use App\Models\Subject;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Modal;
use Orchid\Support\Facades\Alert;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class QuestionsScreen extends Screen
{
    private Subject $subject;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Subject $subject): iterable
    {
        $this->subject = $subject;

        return [
            'subject' => $this->subject->toArray(),
            'questions' => Question::where('subject_id', $subject->id)->get(),
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
     * Create method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(QuestionsRequest $questionsRequest): void
    {
        Question::create($questionsRequest->validated());

        Alert::info('Вопрос создан!');
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
                Input::make('option_a')->title('A')->required(),
                Input::make('option_b')->title('B')->required(),
                Input::make('option_c')->title('C')->required(),
                Input::make('option_d')->title('D')->required(),
                Input::make('option_e')->title('E')->required(),
                Select::make('correct_answer')
                    ->options([
                        'option_a' => AnswerOption::A->name,
                        'option_b' => AnswerOption::B->name,
                        'option_c' => AnswerOption::C->name,
                        'option_d' => AnswerOption::D->name,
                        'option_e' => AnswerOption::E->name,
                    ])
                    ->empty('No select')
                    ->title('Правильный ответ')
                    ->required(),
                Input::make('subject_id')
                    ->value($this->subject->id)
                    ->required()
                    ->hidden(),
            ]))
                ->size(Modal::SIZE_LG)
                ->title('Создание вопроса')
                ->applyButton(__('common.create')),
        ];
    }
}
