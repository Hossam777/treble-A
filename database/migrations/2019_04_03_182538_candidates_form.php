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
        Schema::table('candidates_form', function (Blueprint $table) {
            //
            $table->int('V_ID');
            $table->string('U_MAIL');
            $table->string('A');
            $table->primary(['V_ID','U_MAIL','A']);
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
        });
    }
}
