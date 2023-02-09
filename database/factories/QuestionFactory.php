<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'question' => $this->faker->text(30),
            'sub_question' => $this->faker->text(),
            'grade_number' => rand(10,11),
            'grade_letter' => 'Б',
            'subject_id' => rand(1,3),
            'topic' => $this->faker->text(10),
        ];
    }
}
