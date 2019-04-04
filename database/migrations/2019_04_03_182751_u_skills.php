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
            $table->string('U_MAIL',50);
            $table->string('SKILL',50);
            $table->integer('SCORE');
            $table->primary(['U_MAIL','SKILL']);
            
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
        Schema::table('u_skills', function (Blueprint $table) {
            //

            $table->dropColumn('U_MAIL');
            $table->dropColumn('SKILL');
            $table->dropColumn('SCORE');
            $table->dropPrimary(['U_MAIL','SKILL']);
            
            $table->dropForeign('U_MAIL');

            $table->dropTimestamps();
        });
    }
}
