<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->string('title'); // Title of the exam
            $table->text('description'); // Description of the exam
            $table->unsignedBigInteger('course_id'); // Foreign key to the courses table
            $table->timestamps(); // Created at and updated at fields

            // Foreign key constraint
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
