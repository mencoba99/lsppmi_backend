<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Soal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal', function (Blueprint $table) {
           
            $table->bigIncrements('soal_id');
            $table->text('nick');
            $table->text('soal');
            $table->text('a');
            $table->text('b');
            $table->text('c');
            $table->text('d');
            $table->text('e');
            $table->text('tag');
            $table->text('penjelasan');
            $table->integer('kunci_id');
            $table->integer('jenis_soal_id');
            $table->integer('hit');
            $table->integer('program_type');
            $table->integer('modul_id');
            $table->integer('submodul_id');
           
            $table->tinyInteger('status')->default(1)->comment('1=Active, 0=Inactive'); // 1=Active, 0=Inactive
            $table->boolean('aktif');
            $table->integer('parent');
            $table->timestamps();

            $table->foreign('program_type')->references('id')->on('program_types')->onDelete('cascade');
            $table->foreign('jenis_soal_id')->references('id')->on('soal_jenis')->onDelete('cascade');
          
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal');
    }
}
