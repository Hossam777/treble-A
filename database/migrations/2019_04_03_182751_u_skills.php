<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class USkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('u_skills', function (Blueprint $table) {
            //
            $table->string('U_MAIL');
            $table->string('SKILL');
            $table->int('SCORE');
            $table->primary(['U_MAIL','SKILL']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('u_skills', function (Blueprint $table) {
            //
        });
    }
}
