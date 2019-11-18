<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UjianJadwal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::create('perdana_jadwal', function (Blueprint $table) {
           
            $table->bigIncrements('perdana_jadwal_id');
            $table->string('name');
            $table->integer('perdana_id');
            $table->timestamp('tgl_perdana');
            $table->timestamp('tgl_awal');
            $table->timestamp('tgl_akhir');
            $table->date('hari');
            $table->time('jam');
            $table->text('keterangan');
            $table->integer('user_created');
            $table->boolean('is_aktif');
            $table->boolean('is_pengawas');
            $table->boolean('keyboard_lock');
            $table->integer('emp_id');
            $table->softDeletes();

            $table->foreign('perdana_id')->references('perdana_id')->on('perdana')->onDelete('cascade');
           
        });

       

       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('perdana_jadwal', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
