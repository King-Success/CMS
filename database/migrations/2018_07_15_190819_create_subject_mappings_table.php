<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_mappings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->integer('staff_id');
            $table->integer('class_id');
            $table->integer('session_id');
            $table->integer('term_id');
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
        Schema::dropIfExists('subject_mappings');
    }
}
