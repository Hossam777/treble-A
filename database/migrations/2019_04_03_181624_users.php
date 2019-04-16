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
            $table->string('u_mail',50);
            $table->string('username');
            $table->string('password');
            $table->string('f_name');
            $table->string('l_name');
            $table->integer('age');
            $table->string('gender');
            $table->string('f_o_i_1')->nullable();
            $table->string('f_o_i_2')->nullable();
            $table->string('f_o_i_3')->nullable();
            $table->string('f_o_i_4')->nullable();
            $table->string('f_o_i_5')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token',1500)->nullable();
            
            $table->primary('u_mail');

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
        Schema::dropIfExists("users");
    }
}
