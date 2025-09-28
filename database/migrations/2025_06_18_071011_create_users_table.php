<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            // Custom fields
            $table->string('father_name')->nullable();
            $table->string('student_id')->nullable();
            $table->string('department')->nullable();
            $table->string('cnic')->nullable();
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->string('profile_picture')->nullable();

            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
