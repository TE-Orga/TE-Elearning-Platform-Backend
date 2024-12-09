<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->text('answer'); // The answer text
            $table->unsignedBigInteger('question_id'); // Foreign key to the questions table
            $table->boolean('is_correct')->default(false); // Flag to indicate if the answer is correct
            $table->timestamps(); // Created at and updated at fields

            // Foreign key constraint
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
