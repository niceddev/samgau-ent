<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Grade;
use Orchid\Screen\Fields\Group;
use App\Models\Question;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;

class QuestionsEditScreen extends AbstractMultiLanguageScreen
{
    private Question $question;
    private bool $isCorrectA;
    private bool $isCorrectB;
    private bool $isCorrectC;
    private bool $isCorrectD;
    private bool $isCorrectE;

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
     * Query data.
     *
     * @return array
     */
    public function query(int $id, Question $question): iterable
    {
        $this->question = $question->load('options');

        [ $option_a, $option_b, $option_c, $option_d, $option_e ] = $this->question->options()->get();

        $this->isCorrectA = $option_a->is_correct;
        $this->isCorrectB = $option_b->is_correct;
        $this->isCorrectC = $option_c->is_correct;
        $this->isCorrectD = $option_d->is_correct;
        $this->isCorrectE = $option_e->is_correct;

        return [
            'question' => $question->toArray(),
            'option_a' => $option_a->toArray(),
            'option_b' => $option_b->toArray(),
            'option_c' => $option_c->toArray(),
            'option_d' => $option_d->toArray(),
            'option_e' => $option_e->toArray(),
        ];
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

            Group::make([
                Input::make('option_a.option')->title('Вариант A:')->required(),
                CheckBox::make('option_a.is_correct')->title('Правильный ответ')->value($this->isCorrectA)->sendTrueOrFalse(),
            ]),

            Group::make([
                Input::make('option_b.option')->title('Вариант B:')->required(),
                CheckBox::make('option_b.is_correct')->title('Правильный ответ')->value($this->isCorrectB)->sendTrueOrFalse(),
            ]),

            Group::make([
                Input::make('option_c.option')->title('Вариант C:')->required(),
                CheckBox::make('option_c.is_correct')->title('Правильный ответ')->value($this->isCorrectC)->sendTrueOrFalse(),
            ]),

            Group::make([
                Input::make('option_d.option')->title('Вариант D:')->required(),
                CheckBox::make('option_d.is_correct')->title('Правильный ответ')->value($this->isCorrectD)->sendTrueOrFalse(),
            ]),

            Group::make([
                Input::make('option_e.option')->title('Вариант E:')->required(),
                CheckBox::make('option_e.is_correct')->title('Правильный ответ')->value($this->isCorrectE)->sendTrueOrFalse(),
            ])
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
                Select::make('grade_id')
                    ->fromModel(Grade::class, 'name')
                    ->empty('No select')
                    ->title('Выберите класс'),
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
        dd('s');
        dd($request, $question);
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
