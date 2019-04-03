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
        Schema::table('followed_users', function (Blueprint $table) {
            //
            $table->string('U_MAIL');
            $table->string('F_MAIL');
            $table->primary(['U_MAIL','F_MAIL']);
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
        });
    }
}
