<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ManagementProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_mgt', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->integer('modul_id');
            $table->integer('program_id');
            $table->integer('submodul_id');
            $table->integer('user_created');
            $table->integer('total_soal');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('modul')->onDelete('cascade');
            $table->foreign('submodul_id')->references('id')->on('submodul')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_mgt');
    }
}
