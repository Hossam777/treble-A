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
        Schema::create('users', function (Blueprint $table) {
            //
            $table->string('U_MAIL',50);
            $table->string('PASSWORD');
            $table->string('USERNAME');
            $table->string('F_NAME');
            $table->string('L_NAME');
            $table->integer('AGE');
            $table->string('GENDER');
            $table->string('F_O_I_1');
            $table->string('F_O_I_2');
            $table->string('F_O_I_3');
            $table->string('F_O_I_4');
            $table->string('F_O_I_5');
            $table->primary('U_MAIL');

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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('U_MAIL');
            $table->dropColumn('PASSWORD');
            $table->dropColumn('USERNAME');
            $table->dropColumn('F_NAME');
            $table->dropColumn('L_NAME');
            $table->dropColumn('AGE');
            $table->dropColumn('GENDER');
            $table->dropColumn('F_O_I_1');
            $table->dropColumn('F_O_I_2');
            $table->dropColumn('F_O_I_3');
            $table->dropColumn('F_O_I_4');
            $table->dropColumn('F_O_I_5');
            $table->dropPrimary('U_MAIL');
            $table->dropTimestamps();
        });
    }
}
