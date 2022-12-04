<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->jsonb('question');
            $table->jsonb('sub_question')->nullable();
            $table->jsonb('option_a');
            $table->jsonb('option_b');
            $table->jsonb('option_c');
            $table->jsonb('option_d');
            $table->jsonb('option_e');
            $table->string('correct_answer');
            $table->foreignId('subject_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions');
    }
}
