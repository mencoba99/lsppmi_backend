<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UjianPerdana extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('perdana', function (Blueprint $table) {
           
            $table->bigIncrements('perdana_id');
            $table->string('name');
            $table->timestamp('tgl_awal');
            $table->timestamp('tgl_akhir');
            $table->integer('user_created');
            $table->integer('competence_places_id');
            $table->boolean('hapus');
            $table->softDeletes();

           
            $table->foreign('competence_places_id')->references('id')->on('competence_places')->onDelete('cascade');
          
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
