<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Users extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('U_MAIL');
            $table->string('PASSWORD');
            $table->string('USERNAME');
            $table->string('F_NAME');
            $table->string('L_NAME');
            $table->int('AGE');
            $table->string('GENDER');
            $table->string('F_O_I_1');
            $table->string('F_O_I_2');
            $table->string('F_O_I_3');
            $table->string('F_O_I_4');
            $table->string('F_O_I_5');
            $table->primary('U_MAIL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
