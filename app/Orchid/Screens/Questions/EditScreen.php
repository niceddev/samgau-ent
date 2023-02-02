<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Question;
use App\Models\Subject;
use App\Orchid\Screens\AbstractMultiLanguageScreen;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class EditScreen extends AbstractMultiLanguageScreen
{
    private Subject $subject;
    private Question $question;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Question $question): iterable
    {
        $this->subject = Subject::find($question->subject_id);
        $this->question = $question;

        [ $optionA, $optionB, $optionC, $optionD, $optionE, $optionF, $optionG, $optionH ] = $this->question->options()->get()->toArray();

        return [
            'question' => $question->load('options')->toArray(),
            'options' => [
                'a' => $optionA,
                'b' => $optionB,
                'c' => $optionC,
                'd' => $optionD,
                'e' => $optionE,
                'f' => $optionF,
                'g' => $optionG,
                'h' => $optionH,
            ]
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Редактирование вопроса №' . $this->question->id . " - ". $this->subject->getTranslation('name', 'ru');
    }

    /**
     * Multi translatable fields
     *
     * @return array
     */
    protected function multiLanguageFields(): array
    {

        return [
            Input::make('question.topic')->title('Тема')->required(),
            Input::make('question.question')->title('Вопрос')->required(),
            Quill::make('question.sub_question')->title('Дополнение'),

            Input::make('options.a.option')->title('Вариант A:')
                ->required(),
            Input::make('options.b.option')->title('Вариант B:')
                ->required(),
            Input::make('options.c.option')->title('Вариант C:')
                ->required(),
            Input::make('options.d.option')->title('Вариант D:')
                ->required(),
            Input::make('options.e.option')->title('Вариант E:')
                ->required(),
            Input::make('options.f.option')->title('Вариант D:'),
            Input::make('options.g.option')->title('Вариант G:'),
            Input::make('options.h.option')->title('Вариант H:'),

        ];
    }

    /**
     * Not translatable fields
     *
     * @return array
     */
    protected function singleLanguageFields(): array
    {
        [ $optionA, $optionB, $optionC, $optionD, $optionE ] = $this->question->options()->get()->toArray();

        return [
            Layout::rows([
                Input::make('question.subject_id')->title('Выберите правильные варианты:')->hidden(),

                Group::make([
                    CheckBox::make('options.a.is_correct')->title('A')->value($optionA['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.b.is_correct')->title('B')->value($optionB['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.c.is_correct')->title('C')->value($optionC['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.d.is_correct')->title('D')->value($optionD['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.e.is_correct')->title('E')->value($optionE['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.f.is_correct')->title('F')->value($optionC['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.g.is_correct')->title('G')->value($optionD['is_correct'])->sendTrueOrFalse(),
                    CheckBox::make('options.h.is_correct')->title('H')->value($optionE['is_correct'])->sendTrueOrFalse(),
                ]),

                Select::make('question.grade_number')
                    ->options(['10' => 10, '11' => 11])
                    ->title('Выберите класс'),
                Select::make('question.grade_letter')
                    ->options(array_combine(
                        config('app.kazakh_alphabet'),
                        config('app.kazakh_alphabet')
                    ))
                    ->title('Буква'),
                Input::make('question.subject_id')
                    ->value($this->subject->id)
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
        foreach(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'] as $abc){
            $options[] = $request->input('options.' . $abc);
        }

        $question->update($request->input('question'));

        foreach ($question->options()->get() as $key => $option) {
            $option->update($options[$key]);
        }

        Alert::message('Вопрос №' . $question->id . ' изменен!');

        return redirect()->route('platform.subjects.questions.index', $question->subject_id);
    }

    /**
     * Remove method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Question $question)
    {
        $question->delete();

        Alert::error('Вопрос №' . $question->id . ' удален!');

        return redirect()->route('platform.subjects.questions.index', $question->subject_id);
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
                ->href(route('platform.subjects.questions.index', $this->subject->id)),
            Button::make(__('Save'))
                ->method('save'),
        ];
    }

}
