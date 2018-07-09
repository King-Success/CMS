<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_scores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('class_options_id')->unsigned()->nullable();
            $table->integer('teacher_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('CA1')->nullable();
            $table->integer('CA2')->nullable();
            $table->integer('CA3')->nullable();
            $table->integer('CA4')->nullable();
            $table->integer('CA5')->nullable();
            $table->integer('exam')->nullable();
            $table->integer('total')->nullable();
            $table->integer('position')->nullable();
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
        Schema::dropIfExists('subject_scores');
    }
}
