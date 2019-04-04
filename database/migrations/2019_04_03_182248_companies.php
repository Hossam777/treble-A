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
        Schema::create('companies', function (Blueprint $table) {
            //
            $table->string('C_MAIL',50);
            $table->string('C_PASSWORD');
            $table->string('NAME');
            $table->string('F_O_I_1');
            $table->string('F_O_I_2');
            $table->string('F_O_I_3');
            $table->string('F_O_I_4');
            $table->string('F_O_I_5');
            $table->primary('C_MAIL');

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
        Schema::table('companies', function (Blueprint $table) {
            //
            $table->dropColumn('C_MAIL');
            $table->dropColumn('C_PASSWORD');
            $table->dropColumn('NAME');
            $table->dropColumn('F_O_I_1');
            $table->dropColumn('F_O_I_2');
            $table->dropColumn('F_O_I_3');
            $table->dropColumn('F_O_I_4');
            $table->dropColumn('F_O_I_5');
            $table->dropPrimary('C_MAIL');

            $table->dropTimestamps();
        });
    }
}
