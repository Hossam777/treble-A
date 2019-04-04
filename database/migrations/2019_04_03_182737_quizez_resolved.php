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
            $table->string('U_MAIL',50);
            $table->integer('Q_ID');

            $table->foreign('U_MAIL')
            ->references('U_MAIL')->on('users')
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
        Schema::table('quizez_resolved', function (Blueprint $table) {
            //

            $table->dropColumn('U_MAIL');
            $table->dropColumn('Q_ID');
            $table->dropPrimary(['U_MAIL','Q_ID']);

            $table->dropForeign('U_MAIL');

            $table->dropTimestamps();
        });
    }
}
