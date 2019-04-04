<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApplicationForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application_form', function (Blueprint $table) {
            //
            $table->unsignedInteger('V_ID');
            $table->string('Q');

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
        Schema::table('application_form', function (Blueprint $table) {
            //

            $table->dropColumn('V_ID');
            $table->dropColumn('Q');
            $table->dropPrimary(['V_ID','Q']);

            $table->dropForeign('V_ID');

            $table->dropTimestamps();
        });
    }
}
