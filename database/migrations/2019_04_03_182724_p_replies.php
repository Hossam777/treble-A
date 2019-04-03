<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PReplies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_replies', function (Blueprint $table) {
            //
            $table->int('P_ID');
            $table->string('U_MAIL');
            $table->string('R_Text');
            $table->primary(['P_ID','U_MAIL','R_Text']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('p_replies', function (Blueprint $table) {
            //
        });
    }
}
