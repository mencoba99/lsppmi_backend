<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalHari extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hari', function (Blueprint $table) {
           
            $table->bigIncrements('hari_id');
            $table->string('name');
        });

        Schema::create('jam', function (Blueprint $table) {
           
            $table->bigIncrements('jam_id');
            $table->string('name');
            $table->boolean('aktif');
            $table->time('tgl_buat');
            $table->integer('user_buat');
           
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
