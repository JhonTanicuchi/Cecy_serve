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
        Schema::create(
            'enrollments',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('student_id')->unsigned();
                $table->foreign('student_id')->references('id')->on('students');
                $table->integer('career_id')->unsigned();
                $table->foreign('career_id')->references('id')->on('careers');
                $table->integer('course_id')->unsigned();
                $table->foreign('course_id')->references('id')->on('courses');
                $table->date('date');
                $table->integer('state_id')->unsigned();
                $table->foreign('state_id')->references('id')->on('catalogs');
                $table->integer('type_enrollment_id')->unsigned();
                $table->foreign('type_enrollment_id')->references('id')->on('catalogs');
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('enrollments');
    }
};
