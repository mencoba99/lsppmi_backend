<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class WaktuSisaPerdana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktu_sisa_perdana', function (Blueprint $table) {
           
            $table->bigIncrements('waktu_sisa_perdana_id');
            $table->integer('batch_id');
            $table->integer('peserta_id');
            $table->integer('sisa_soal');
            $table->integer('waktu_persoal');
            $table->integer('sisa_waktu');
            $table->timestamp('date_created');
           
           
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
