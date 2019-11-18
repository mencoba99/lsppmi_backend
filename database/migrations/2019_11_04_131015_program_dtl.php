<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProgramDtl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_dtl', function (Blueprint $table) {
           
            $table->bigIncrements('program_dtl_id');
            $table->string('nama');
            $table->integer('modul_id');
            $table->integer('program_id');
            $table->integer('submodul_id');
            $table->integer('date_created');
            $table->integer('user_created');
            $table->integer('user_deleted');
            $table->integer('persentase_kelulusan');
            $table->integer('total_soal');
            $table->softDeletes();

            // $table->foreign('soal_id')->references('soal_id')->on('soal')->onDelete('cascade');
            $table->foreign('modul_id')->references('id')->on('modul')->onDelete('cascade');
            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
            $table->foreign('submodul_id')->references('id')->on('submodul')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropSoftDeletes();
        Schema::dropIfExists('program_dtl');
    }
}
