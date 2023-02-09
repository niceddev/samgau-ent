<?php

namespace App\Services;

use App\Enums\Score;

class TestService
{
    public function scoreSystem(int $rightAnswersCount, int $correctAnswersCount, int $mistakesCount): int
    {
        if ($rightAnswersCount !== 1) {

            return match(true) {
                ($rightAnswersCount === $correctAnswersCount) && $mistakesCount === 0 => Score::TWO->value,
                ($rightAnswersCount === $correctAnswersCount) && $mistakesCount === 1, ($correctAnswersCount === 1) && $mistakesCount <= 1 => Score::ONE->value,
                default => Score::YOU_ARE_STUPID->value
            };

        } else {

            return match(true) {
                $correctAnswersCount === 1 => Score::ONE->value,
                default => Score::YOU_ARE_STUPID->value
            };

        }
    }
}
