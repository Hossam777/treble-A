<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CandidatesForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidates_form', function (Blueprint $table) {
            //
            $table->unsignedInteger('v_id');
            $table->string('u_mail',50);
            $table->string('a');
            
            $table->foreign('v_id')
            ->references('v_id')->on('vacancies')
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
        Schema::dropIfExists('candidates_form');
    }
}
