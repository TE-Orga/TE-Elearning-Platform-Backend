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
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->text('question_text'); // The question text
            $table->string('question_type'); // The type of the question (e.g., multiple choice, true/false)
            $table->unsignedBigInteger('exam_id'); // Foreign key to the exams table
            $table->string('correct_answer'); // The correct answer for the question
            $table->timestamps(); // Created at and updated at fields

            // Foreign key constraint
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
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
