<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $questions = [];
         $options = [];

         for ($i = 0; $i <= 2000; $i++) {

             $questions[] = [
                 'question' => rand(1,100) . rand(1,100),
                 'sub_question' => null,
                 'grade_number' => rand(10,11),
                 'grade_letter' => 'Б',
                 'subject_id' => rand(1,3),
                 'topic' => 'asd',
             ];

         }

        for ($i = 0; $i <= 40000; $i++) {

            $options[] = [
                'option' => rand(1,100),
                'question_id' => rand(1,2000),
                'is_correct' => rand(true, false),
            ];

        }

        foreach (array_chunk($questions, 1000) as $chunk) {
            Question::insert($chunk);
        }

        foreach (array_chunk($options, 1000) as $chunk) {
            Option::insert($chunk);
        }



    }
}
