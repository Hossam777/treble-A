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
        Schema::create('vacancies', function (Blueprint $table) {
            //
            $table->increments('V_ID');
            $table->string('C_MAIL',50);
            $table->string('TITLE');
            $table->string('DESCRIPTION');
            $table->string('REQUIRMENTS');
            $table->string('BENIFITS');
            $table->double('SALARY');
            $table->string('TYPE');

            $table->foreign('C_MAIL')
            ->references('C_MAIL')->on('companies')
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
        Schema::table('vacancies', function (Blueprint $table) {
            //

            $table->dropColumn('V_ID');
            $table->dropColumn('C_MAIL');
            $table->dropColumn('TITLE');
            $table->dropColumn('DESCRIPTION');
            $table->dropColumn('REQUIRMENTS');
            $table->dropColumn('BENIFITS');
            $table->dropColumn('SALARY');
            $table->dropColumn('TYPE');
            $table->dropPrimary('V_ID');

            $table->dropForeign('C_MAIL');

            $table->dropTimestamps();
        });
    }
}
