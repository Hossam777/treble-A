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
            $table->string('u_mail',50);
            $table->string('f_mail',50);
            
            $table->foreign('u_mail')
            ->references('u_mail')->on('users')
            ->onDelete('cascade');
      
            $table->foreign('f_mail')
            ->references('u_mail')->on('users')
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
        Schema::dropIfExists('followed_users');
    }
}
