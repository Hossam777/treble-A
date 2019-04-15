<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QuizezResolved extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizez_resolved', function (Blueprint $table) {
            //
            $table->string('u_mail',50);
            $table->integer('q_id');

            $table->foreign('u_mail')
            ->references('u_mail')->on('users')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('quizez_resolved');
    }
}
