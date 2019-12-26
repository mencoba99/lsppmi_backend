<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProgramMgtKUK extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_mgt_kuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->unsignedInteger('program_id')->nullable();
            $table->unsignedInteger('modul_id')->nullable();
            $table->unsignedInteger('submodul_id')->nullable();
            $table->integer('total_soal');
            $table->integer('status');
            $table->integer('user_created');
            $table->timestamps();
            $table->softDeletes();
        });
    }
   
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_mgt_kuk');
    }
}
