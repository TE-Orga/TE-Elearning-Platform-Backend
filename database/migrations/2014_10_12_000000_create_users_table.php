<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary Key (auto-incrementing ID)
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique(); // Unique email for each user
            $table->string('password'); // Hashed password
            $table->string('picture')->nullable(); // Picture of the user, nullable
            $table->string('phone_number')->nullable(); // Phone number, nullable
            $table->enum('role', ['employee', 'contractor', 'visitor']); // Role of the user
            $table->string('department')->nullable(); // Only for employees
            $table->string('valuestream')->nullable(); // Only for employees
            $table->string('manager')->nullable(); // Only for employees
            $table->string('te_id')->nullable(); // Only for employees
            $table->date('date_visit')->nullable(); // Only for visitors
            $table->string('cin_passport_picture')->nullable(); // Picture of ID for visitors and contractors
            $table->string('etablissement')->nullable(); // Only for visitors
            $table->string('visit_purpose')->nullable(); // Only for visitors
            $table->string('nationality')->nullable(); // Only for contractors
            $table->string('enterprise')->nullable(); // Only for contractors
            $table->string('visit_period')->nullable(); // Only for contractors
            $table->string('collab_field')->nullable(); // Only for contractors
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
        Schema::dropIfExists('users');
    }
};
