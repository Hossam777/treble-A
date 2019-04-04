<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidatesForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates_form', function (Blueprint $table) {
            //
            $table->unsignedInteger('V_ID');
            $table->string('U_MAIL',50);
            $table->string('A');
            
            $table->foreign('V_ID')
            ->references('V_ID')->on('vacancies')
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
        Schema::table('candidates_form', function (Blueprint $table) {
            //

            $table->dropColumn('V_ID');
            $table->dropColumn('U_MAIL');
            $table->dropColumn('A');
            $table->dropPrimary(['V_ID','U_MAIL','A']);
            
            $table->dropForeign('V_ID');

            $table->dropTimestamps();
        });
    }
}
