<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UjianDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_detail', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_detail_id');
            $table->integer('ujian_id');
            $table->integer('ulang_jadwal_id');
            $table->integer('perdana_jadwal_id');
            $table->string('nama_ujian');
            $table->timestamp('tgl_ujian');
            $table->integer('modul_id');
            $table->string('nama_modul');
            $table->integer('nilai');
            $table->string('lokasi');
            $table->string('cabang');
            $table->string('kp');
            $table->string('status_ujian');
            $table->integer('persentase_kelulusan');
            $table->boolean('is_pengawas');
            $table->string('nama_pengawas');
           
           
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
