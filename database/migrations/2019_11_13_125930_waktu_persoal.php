<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WaktuPersoal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktu_persoal', function (Blueprint $table) {
           
            $table->bigIncrements('waktu_persoal_id');
            $table->integer('batch_id');
            $table->integer('durasi_ujian');
            $table->string('nama_batch');
            $table->integer('total_soal_ujian');
            $table->integer('waktu_persoal');
            $table->boolean('aktivasi');
            $table->timestamp('date_created');
            $table->integer('user_created');
           
           
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
