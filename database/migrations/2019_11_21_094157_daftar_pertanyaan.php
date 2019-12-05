<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DaftarPertanyaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pertanyaan_tertulis', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->integer('unit_id');
            $table->integer('tuk_id');
            $table->integer('element_id');
            $table->integer('kuk_id');
            $table->longText('pertanyaan');
            $table->longText('jawaban');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
           
            $table->foreign('unit_id')->references('id')->on('competence_units')->onDelete('cascade');
            $table->foreign('tuk_id')->references('id')->on('competence_places')->onDelete('cascade');
            $table->foreign('element_id')->references('id')->on('competence_elements')->onDelete('cascade');
            $table->foreign('kuk_id')->references('id')->on('competence_kuk')->onDelete('cascade');
           
        });

        Schema::create('pertanyaan_lisan', function (Blueprint $table) {
           
            $table->bigIncrements('id');
            $table->integer('unit_id');
            $table->integer('tuk_id');
            $table->integer('element_id');
            $table->integer('kuk_id');
            $table->longText('pertanyaan');
            $table->longText('jawaban');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
           
            $table->foreign('unit_id')->references('id')->on('competence_units')->onDelete('cascade');
            $table->foreign('tuk_id')->references('id')->on('competence_places')->onDelete('cascade');
            $table->foreign('element_id')->references('id')->on('competence_elements')->onDelete('cascade');
            $table->foreign('kuk_id')->references('id')->on('competence_kuk')->onDelete('cascade');
           
           
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertanyaan_tertulis');
        Schema::dropIfExists('pertanyaan_lisan');
    }
}
