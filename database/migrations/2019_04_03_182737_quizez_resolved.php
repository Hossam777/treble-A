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
        Schema::table('quizez_resolved', function (Blueprint $table) {
            //
            $table->string('U_MAIL');
            $table->int('Q_ID');
            $table->primary(['U_MAIL','Q_ID']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quizez_resolved', function (Blueprint $table) {
            //
        });
    }
}
