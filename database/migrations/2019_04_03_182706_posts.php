<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Posts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            //
            $table->increments('P_ID');
            $table->string('U_MAIL',50);
            $table->string('P_TEXT');
            $table->string('PRIVACY');
            $table->integer('VOTE');
            
            $table->foreign('U_MAIL')
            ->references('U_MAIL')->on('users')
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
        Schema::table('posts', function (Blueprint $table) {
            //


            $table->dropColumn('P_ID');
            $table->dropColumn('U_MAIL');
            $table->dropColumn('P_TEXT');
            $table->dropColumn('PRIVACY');
            $table->dropColumn('VOTE');
            $table->dropPrimary('P_ID');
            
            $table->dropForeign('U_MAIL');

            $table->dropTimestamps();
        });
    }
}
