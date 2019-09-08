<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SubjectAllocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->unsigned();
            $table->bigInteger('faculty_id')->unsigned();
            $table->bigInteger('subject_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('subject_allocations',function(Blueprint $table){
            $table->foreign('class_id')->references('id')->on('classes');
            $table->foreign('faculty_id')->references('id')->on('faculties');
            $table->foreign('subject_id')->references('id')->on('subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subject_allocations');
    }
}
