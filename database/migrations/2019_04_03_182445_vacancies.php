<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Vacancies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            //
            $table->increments('v_id');
            $table->string('c_mail',50);
            $table->string('title');
            $table->string('description');
            $table->string('requirments');
            $table->string('benifits');
            $table->double('salary');
            $table->string('type');

            $table->foreign('c_mail')
            ->references('c_mail')->on('companies')
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
        Schema::dropIfExists('vacancies');
    }
}
