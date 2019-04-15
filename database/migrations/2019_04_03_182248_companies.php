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
            $table->string('c_mail',50);
            $table->string('c_password');
            $table->string('name');
            $table->string('f_o_i_1');
            $table->string('f_o_i_2');
            $table->string('f_o_i_3');
            $table->string('f_o_i_4');
            $table->string('f_o_i_5');
            $table->primary('c_mail');

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
        Schema::dropIfExists('companies');
    }
}
