<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PendaftaranUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran_trx', function (Blueprint $table) {
           
            $table->bigIncrements('pendaftaran_trx_id');
            $table->integer('pendaftaran_id');
            $table->integer('peserta_aktivasi_id');
            $table->integer('batch_id');
            $table->string('nama_batch');
            $table->string('no_batch');
            $table->integer('peserta_id');
            $table->string('nama_peserta');
            $table->string('no_va');
            $table->string('no_invoice');
            $table->timestamp('tgl_daftar');
            $table->string('harga_pendaftaran');
           
           
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
