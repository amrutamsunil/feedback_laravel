<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Feedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('sa_id')->unsigned();
            $table->smallInteger('q1');
            $table->smallInteger('q2');
            $table->smallInteger('q3');
            $table->smallInteger('q4');
            $table->smallInteger('q5');
            $table->smallInteger('q6');
            $table->smallInteger('q7');
            $table->smallInteger('q8');
            $table->smallInteger('q9');
            $table->smallInteger('q10');
            $table->integer('sum');
            $table->smallInteger('phase');
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
        Schema::dropIfExists('feedbacks');
    }
}
