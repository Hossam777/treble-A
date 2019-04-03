<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->string('C_MAIL');
            $table->string('C_PASSWORD');
            $table->string('NAME');
            $table->string('F_O_I_1');
            $table->string('F_O_I_2');
            $table->string('F_O_I_3');
            $table->string('F_O_I_4');
            $table->string('F_O_I_5');
            $table->primary('C_MAIL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
}
