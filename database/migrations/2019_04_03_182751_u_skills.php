<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class USkills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('u_skills', function (Blueprint $table) {
            //
            $table->string('u_mail',50);
            $table->string('skill',50);
            $table->integer('score');
            $table->primary(['u_mail','skill']);
            
            $table->foreign('u_mail')
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
        Schema::dropIfExists('u_skills');
    }
}
