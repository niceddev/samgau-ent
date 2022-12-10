<?php

namespace App\Orchid\Screens\Questions;

use App\Enums\AnswerOption;
use App\Models\Question;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class QuestionsEditScreen extends AbstractMultiLanguageScreen
{
    private Question $question;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Question $question): iterable
    {
        $this->question = $question;

        return [
            'question' => $question->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return __('common.edit') . ' ' . __('common.question');
    }

    /**
     * Multi translatable fields
     *
     * @return array
     */
    protected function multiLanguageFields(): array
    {
        return [
            Input::make('question.question')
                ->placeholder(__('common.example') . ' Сколько будет 5:5+5*5?')
                ->title('Введите название ' . __('common.question') . 'а')
                ->required(),
            Quill::make('question.sub_question')
                ->placeholder(__('common.example') . ' Дополнение к вопросу')
                ->title('Дополнение к вопросу'),
            Input::make('question.option_a')
                ->placeholder(__('common.example') . ' 30')
                ->title('Ответ A')
                ->required(),
            Input::make('question.option_b')
                ->placeholder(__('common.example') . ' 12')
                ->title('Ответ B')
                ->required(),
            Input::make('question.option_c')
                ->placeholder(__('common.example') . ' 26')
                ->title('Ответ C')
                ->required(),
            Input::make('question.option_d')
                ->placeholder(__('common.example') . ' 24')
                ->title('Ответ D')
                ->required(),
            Input::make('question.option_e')
                ->placeholder(__('common.example') . ' 777')
                ->title('Ответ E')
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
                Select::make('question.correct_answer')
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
                Input::make('question.subject_id')
                    ->value($this->question->subject_id)
                    ->required()
                    ->hidden(),
            ])
        ];
    }

    /**
     * Save method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Question $question, Request $request)
    {
        $question->update($request->input('question'));

        Alert::message('Сохранено!');

        return redirect()->route('platform.questions.index', $question->subject_id);
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Question $question)
    {
        $question->delete();

        Alert::error('Удалено!');

        return redirect()->route('platform.questions.index', $question->subject_id);
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
                ->href(route('platform.questions.index', $this->question->subject_id)),
            Button::make(__('Save'))
                ->method('save'),
        ];
    }

}
