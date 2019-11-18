<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PesertaUjian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta_lulus', function (Blueprint $table) {
           
            $table->bigIncrements('peserta_lulus_id');
            $table->integer('peserta_id');
            $table->integer('batch_id');
            $table->string('no_sertifikat');
            $table->string('nama_peserta');
            $table->string('nama_program');
            $table->string('singkatan_ind');
            $table->string('singkatan_eng');
            $table->integer('print_count');
            $table->boolean('is_copy');
            $table->timestamp('date_created');
            $table->string('nama_batch');
            $table->string('email');
            $table->string('tempat_lahir');
            $table->timestamp('tgl_lahir');
           
           
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
