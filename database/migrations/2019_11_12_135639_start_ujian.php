<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class StartUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_jawab', function (Blueprint $table) {
           
            $table->bigIncrements('peserta_jawab_id');
            $table->integer('soal_peserta_id');
            $table->integer('soal_id');
            $table->integer('ulangkunci_id_jadwal_id');
            $table->boolean('is_bener');
            $table->integer('nilai');
           
           
        });

        Schema::create('peserta_lulus_id', function (Blueprint $table) {
           
            $table->bigIncrements('peserta_jawab_id');
            $table->integer('peserta_id');
            $table->integer('batch_id');
            $table->string('no_sertifikat');
            $table->string('nama_peserta');
            $table->string('nama_program');
            $table->string('singkatan_ind');
            $table->string('singkatan_eng');
            $table->string('email');
            $table->string('tempat_lahir');
            $table->integer('print_count');
            $table->integer('lembg_pdkn_id');
            $table->integer('program_id');
            $table->string('nama_batch');
            $table->string('nama_lokasi');
            $table->string('nama_cabang');
            $table->string('nama_lembg_pdkn');
            $table->string('photo');
            $table->boolean('is_cetak');
            $table->boolean('is_diambil');
            $table->boolean('is_copy');
            $table->boolean('is_dikirim');
            $table->boolean('is_confirm');
            $table->timestamp('tgl_kirim');
            $table->timestamp('tgl_lulus');
            $table->timestamp('tgl_cetak');
            $table->timestamp('tgl_confirm');
            $table->timestamp('tgl_diambil');
            $table->timestamp('tgl_lahir');
            $table->timestamp('date_created');
           
           
        });

        Schema::create('perdana_peserta', function (Blueprint $table) {
           
            $table->bigIncrements('perdana_peserta_id');
            $table->integer('ujian_batch_id');
            $table->integer('peserta_id');
            $table->integer('user_created');
            $table->timestamp('created_at');
            $table->boolean('aktivasi');
           
           
           
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
