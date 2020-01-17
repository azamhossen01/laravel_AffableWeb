<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('fathers_name');
            $table->string('mothers_name');
            $table->enum('gender',['Male','Female']);
            $table->string('institution');
            $table->string('cell');
            $table->string('email');
            $table->text('address');
            $table->string('course_name');
            $table->string('course_code');
            $table->string('batch_no');
            $table->string('password');
            $table->boolean('mode')->default(0);
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
        Schema::dropIfExists('students');
    }
}
