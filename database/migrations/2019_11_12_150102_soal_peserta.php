<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SoalPeserta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_peserta', function (Blueprint $table) {
           
            $table->bigIncrements('soal_peserta_id');
            $table->integer('ujian_modul_id');
            $table->integer('perdana_peserta_id');
            $table->integer('nilai_ujian');
            $table->integer('persentase_kelulusan');
            $table->integer('nilai');
            $table->boolean('is_lulus');
           
           
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
