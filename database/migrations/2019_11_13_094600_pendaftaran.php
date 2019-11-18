<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pendaftaran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
           
            $table->bigIncrements('pendaftaran_id');
            $table->integer('batch_id');
            $table->integer('peserta_id');
            $table->integer('va_id');
            $table->timestamp('tgl_daftar');
            $table->string('harga_pendaftaran');
            $table->string('no_invoice');
            $table->string('keterangan');
            $table->timestamp('date_created');
            $table->integer('user_created');
            $table->timestamp('date_deleted');
            $table->integer('user_deleted');
            $table->string('no_reg_wppe');
            $table->integer('pendaftaran_status_id');
            $table->string('pendaftaran_status_nama');
            $table->string('file_ijazah');
            $table->boolean('hapus');
            $table->string('file_ijazah_ori');
            $table->integer('voucher_id');
            $table->string('account_no');
           
           
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
