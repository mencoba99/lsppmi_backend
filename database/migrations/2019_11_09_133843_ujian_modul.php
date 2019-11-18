<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UjianModul extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ujian_batch', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_batch_id');
            $table->integer('perdana_jadwal_id');
            $table->string('name');
            $table->string('keterangan');
            $table->integer('program_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();
        });

        Schema::create('ujian_modul', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_modul_id');
            $table->integer('ujian_batch_id');
            $table->integer('modul_id');
            $table->integer('submodul_id');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();
           
        });
        

        Schema::create('ujian', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_id');
            $table->integer('program_id');
            $table->integer('member_id');
            $table->string('name');
            $table->string('member_name');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

           
        });

        Schema::create('ujian_jenis', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_jenis_id');
            $table->string('kode');
            $table->integer('user_created');
            $table->string('name');
            $table->string('keterangan');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

           
        });

        Schema::create('ujian_peserta', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_peserta_id');
            $table->integer('ujian_pendaftaran_id');
            $table->boolean('is_aktivasi');
            $table->integer('user_created');
            $table->boolean('selesai');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

           
        });

        Schema::create('ujian_parameter', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_parameter_id');
            $table->integer('durasi_masa_aktif_ujian');
            $table->string('name');
            $table->string('keterangan');
            $table->integer('durasi_default_ujian');
            $table->integer('user_created');
            $table->integer('user_deleted');
            $table->boolean('aktif');
            $table->boolean('hapus');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

           
        });

        Schema::create('ujian_pendaftan', function (Blueprint $table) {
           
            $table->bigIncrements('ujian_pendaftaran_id');
            $table->integer('program_id');
            $table->integer('member_id');
            $table->integer('ulang_jadwal_id');
            $table->integer('pendaftaran_id');
            $table->string('member_name');
            $table->string('email');
            $table->string('programe_name');
            $table->string('tuk_name');
            $table->timestamp('tgl_daftar');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->softDeletes();

           
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
