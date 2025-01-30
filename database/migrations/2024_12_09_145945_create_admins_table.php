<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->string('first_name'); // Admin's first name
            $table->string('last_name'); // Admin's last name
            $table->string('email')->unique(); // Admin's unique email
            $table->string('password'); // Hashed password
            $table->string('picture')->nullable(); // Admin's picture, nullable
            $table->string('phone_number')->nullable(); // Admin's phone number, nullable
            $table->integer('role'); // For numeric role representation
            $table->string('te_id')->nullable(); // Admin's TE ID (if applicable)
            $table->timestamps(); // Created at and updated at fields
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
