<?php

namespace App\Orchid\Screens\Questions;

use App\Models\Question;
use App\Models\Subject;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class IndexScreen extends Screen
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
            'subject'   => $this->subject,
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
            Link::make(__('Create'))
                ->href(route('platform.question.create', $this->subject)),
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
        ];
    }

}
