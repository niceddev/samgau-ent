<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Option;
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

class CreateScreen extends AbstractMultiLanguageScreen
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
            'subject' => $subject->toArray()
        ];
    }

    /**
     * Display header name.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Создание вопроса: ' . $this->subject->getTranslation('name', 'ru');
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
                ->href(route('platform.subjects.questions.index', $this->subject->id)),
            Button::make(__('Save'))
                ->method('save', [ $this->subject->id ]),
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
            Input::make('question')->title('Вопрос')->required(),
            Quill::make('sub_question')->title('Дополнение'),

            Input::make('option.a')->title('Вариант A:')->required(),
            Input::make('option.b')->title('Вариант B:')->required(),
            Input::make('option.c')->title('Вариант C:')->required(),
            Input::make('option.d')->title('Вариант D:')->required(),
            Input::make('option.e')->title('Вариант E:')->required(),
            Input::make('option.f')->title('Вариант F:'),
            Input::make('option.g')->title('Вариант G:'),
            Input::make('option.h')->title('Вариант H:'),

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
                Input::make('subject_id')->title('Выберите правильные варианты:')->hidden(),

                Group::make([
                    CheckBox::make('is_correct_a')->title('A')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_b')->title('B')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_c')->title('C')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_d')->title('D')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_e')->title('E')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_f')->title('F')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_g')->title('G')->sendTrueOrFalse(),
                    CheckBox::make('is_correct_h')->title('H')->sendTrueOrFalse(),
                ]),

                Input::make('grade_number')
                    ->type('number')
                    ->title('Выберите класс'),
                Select::make('grade_letter')
                    ->options(array_combine(
                        config('app.kazakh_alphabet'),
                        config('app.kazakh_alphabet')
                    ))
                    ->title('Буква'),
                Input::make('subject_id')
                    ->value($this->subject->id)
                    ->hidden(),

            ])
        ];
    }

    /**
     * Create method.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, int $subjectId)
    {
        foreach(['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'] as $abc){
            $options[] = [
                'option' => $request->input('option.' . $abc),
                'is_correct' => $request->input('is_correct_' . $abc),
            ];
        }

        $question = Question::create([
            'question'     => $request->input('question'),
            'sub_question' => $request->input('sub_question'),
            'grade_number' => $request->input('grade_number'),
            'grade_letter' => $request->input('grade_letter'),
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

        return redirect()->route('platform.subjects.questions.index', $subjectId);
    }

}
