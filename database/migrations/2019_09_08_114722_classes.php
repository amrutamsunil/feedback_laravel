<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class classes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('name');
            $table->integer('semester');
            $table->String('section');
            $table->integer('batch');
            $table->tinyInteger('isActive');
            $table->bigInteger('dept_id')->unsigned();
            $table->timestamps();
        });
        Schema::table('classes',function (Blueprint $table){
            $table->foreign('dept_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
