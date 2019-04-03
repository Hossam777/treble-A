<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vacancies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            //
            $table->int('V_ID');
            $table->string('C_MAIL');
            $table->string('TITLE');
            $table->string('DESCRIPTION');
            $table->string('REQUIRMENTS');
            $table->string('BENIFITS');
            $table->double('SALARY');
            $table->string('TYPE');
            $table->primary('V_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vacancies', function (Blueprint $table) {
            //
        });
    }
}
