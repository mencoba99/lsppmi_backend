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
        Schema::create('komposisi_soal', function (Blueprint $table) {
           
            $table->bigIncrements('komposisi_soal_id');
            $table->integer('program_mgt_id');
            $table->integer('jenis_soal_id');
            $table->integer('jumlah_soal');
          

            $table->foreign('program_mgt_id')->references('id')->on('program_mgt')->onDelete('cascade');
            $table->foreign('jenis_soal_id')->references('id')->on('soal_jenis')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('komposisi_soal');
    }
}
