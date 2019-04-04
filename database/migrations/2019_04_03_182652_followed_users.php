<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FollowedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followed_users', function (Blueprint $table) {
            //
            $table->string('U_MAIL',50);
            $table->string('F_MAIL',50);
            
            $table->foreign('U_MAIL')
            ->references('U_MAIL')->on('users')
            ->onDelete('cascade');
      
            $table->foreign('F_MAIL')
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
        Schema::table('followed_users', function (Blueprint $table) {
            //


            $table->dropColumn('U_MAIL');
            $table->dropColumn('F_MAIL');
            $table->dropPrimary(['U_MAIL','F_MAIL']);
            
            $table->dropForeign('U_MAIL');
      
            $table->dropForeign('F_MAIL');

            $table->dropTimestamps();
        });
    }
}
