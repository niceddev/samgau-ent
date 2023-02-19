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
            $table->smallInteger('grade_number')->nullable();
            $table->string('grade_letter')->nullable();
            $table->integer('subject_id');
            $table->jsonb('topic');
            $table->boolean('are_many_answers')->default(false);
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
