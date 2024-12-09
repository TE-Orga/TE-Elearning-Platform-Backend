<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->string('title'); // Title of the course
            $table->text('description'); // Course description
            $table->unsignedBigInteger('creator_id'); // Foreign key to the admins or coaches table
            $table->timestamps(); // Created at and updated at fields
            
            // Foreign key constraint
            $table->foreign('creator_id')->references('id')->on('admins')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
