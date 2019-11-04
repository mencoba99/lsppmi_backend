<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KomposisiSoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modul_soal', function (Blueprint $table) {
           
            $table->bigIncrements('modul_soal_id');
            $table->integer('soal_id');
            $table->integer('submodul_id');
            $table->integer('modul_id');
          

            // $table->foreign('soal_id')->references('soal_id')->on('soal')->onDelete('cascade');
            $table->foreign('submodul_id')->references('id')->on('submodul')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('modul')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
