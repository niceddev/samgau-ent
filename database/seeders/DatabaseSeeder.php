<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Subject::all()
            ->each(function ($subject) use (&$lastId) {
                $questions = [];

                for ($i = 1; $i <= 100; $i++) {
                    $questions[] = [
                        'question'         => '{"ru":"' . $this->generateRandomString(20) . '"}',
                        'sub_question'     => null,
                        'grade_number'     => rand(10, 11),
                        'grade_letter'     => 'Б',
                        'subject_id'       => $subject->id,
                        'topic'            => '{"ru":"' . $subject->name . '"}',
                        'are_many_answers' => false
                    ];
                }

                for ($i = 1; $i <= 100; $i++) {
                    $questions[] = [
                        'question'         => '{"ru":"' . $this->generateRandomString(20) . '"}',
                        'sub_question'     => null,
                        'grade_number'     => rand(10, 11),
                        'grade_letter'     => 'Б',
                        'subject_id'       => $subject->id,
                        'topic'            => '{"ru":"' . $subject->name . '"}',
                        'are_many_answers' => true
                    ];
                }

                foreach (array_chunk($questions, 100) as $chunk) {
                    Question::insert($chunk);
                }

            });

        $options = [];

        Question::where('are_many_answers', false)->chunk(500, function ($questions) use ($options) {
            foreach ($questions as $question) {
                $options[] = [
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false,
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"000000"}',
                        'question_id' => $question->id,
                        'is_correct'  => true
                    ],
                ];
            }

            foreach (array_chunk($options, 500) as $optionsChunk) {
                foreach ($optionsChunk as $chunk) {
                    Option::insert($chunk);
                }
            }
        });

        Question::where('are_many_answers', true)->chunk(500, function ($questions) use ($options) {
            foreach ($questions as $question) {
                $options[] = [
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false,
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => false
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => true
                    ],
                    [
                        'option'      => '{"ru":"'. $question->id . ' - ' .$this->generateRandomString().'"}',
                        'question_id' => $question->id,
                        'is_correct'  => true
                    ],
                    [
                        'option'      => '{"ru":"000000"}',
                        'question_id' => $question->id,
                        'is_correct'  => true
                    ],
                ];
            }

            foreach (array_chunk($options, 500) as $optionsChunk) {
                foreach ($optionsChunk as $chunk) {
                    Option::insert($chunk);
                }
            }
        });
    }

    private function generateRandomString($length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
