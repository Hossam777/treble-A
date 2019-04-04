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
        Schema::create('p_replies', function (Blueprint $table) {
            //
            $table->unsignedInteger('P_ID');
            $table->string('U_MAIL',50);
            $table->string('R_Text');

            $table->foreign('U_MAIL')
            ->references('U_MAIL')->on('users')
            ->onDelete('cascade');

            $table->foreign('P_ID')
            ->references('P_ID')->on('posts')
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
        Schema::table('p_replies', function (Blueprint $table) {
            //

            $table->dropColumn('P_ID');
            $table->dropColumn('U_MAIL');
            $table->dropColumn('R_Text');
            $table->dropPrimary(['P_ID','U_MAIL','R_Text']);

            $table->dropForeign('U_MAIL');

            $table->dropForeign('P_ID');

            $table->dropTimestamps();
        });
    }
}
