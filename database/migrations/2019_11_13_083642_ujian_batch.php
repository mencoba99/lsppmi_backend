<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UjianBatch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batch_modul_dtl', function (Blueprint $table) {
           
            $table->bigIncrements('batch_modul_dtl_id');
            $table->integer('batch_id');
            $table->string('nama_modul');
            $table->integer('harga_modul');
            $table->integer('persentase_kelulusan_modul');
            $table->integer('modul_id');
           
           
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
