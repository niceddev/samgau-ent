<?php

namespace App\Services;

use App\Enums\Score;
use App\Models\Question;

class TestService
{
    public function scoreSystem(array $subjectIds, array $userAnswers): int
    {
        $score = 0;

        $questionsIds = [];
        foreach ($subjectIds as $subjectId) {
            if (!empty($userAnswers['subject-' . $subjectId])) {
                foreach ((array)$userAnswers['subject-' . $subjectId] as $question => $answers) {
                    $questionsIds[] = intval(substr($question, 10));
                }
            }
        }

        $questions = Question::with('options')
            ->whereIn('id', $questionsIds)
            ->get();

        foreach ($questions as $question) {
            $rightAnswers = $question->optionsForTest
                ->where('is_correct', true)
                ->pluck('id')
                ->toArray();

            $correctAnswers = array_intersect($userAnswers['subject-' . $question->subject_id]['questions-' . $question->id], $rightAnswers);
            $mistakes = array_diff($userAnswers['subject-' . $question->subject_id]['questions-' . $question->id], $rightAnswers);

            $score += $this->countScore(
                count($rightAnswers),
                count($correctAnswers),
                count($mistakes),
            );
        }

        return $score;
    }

    private function countScore(int $rightAnswersCount, int $correctAnswersCount, int $mistakesCount): int
    {
        $score = 0;

        if ($rightAnswersCount !== 1) {
            $score += match(true) {
                ($rightAnswersCount === $correctAnswersCount) && $mistakesCount === 0 => Score::TWO->value,
                ($rightAnswersCount === $correctAnswersCount) && $mistakesCount === 1,
                ($correctAnswersCount === ($rightAnswersCount - 1)) => Score::ONE->value,
                default => Score::YOU_ARE_STUPID->value
            };
        } else {
            $score += match(true) {
                $correctAnswersCount === 1 => Score::ONE->value,
                default => Score::YOU_ARE_STUPID->value
            };
        }

        return $score;
    }

}
