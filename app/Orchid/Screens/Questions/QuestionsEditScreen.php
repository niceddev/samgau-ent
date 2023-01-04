<?php

namespace App\Orchid\Screens\Questions;

use App\Enums\AnswerOption;
use App\Models\Grade;
use App\Models\Option;
use App\Models\Question;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
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
            'question' => $question->toArray(),
            'options' => Option::where('question_id', $question->id)->get()
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
