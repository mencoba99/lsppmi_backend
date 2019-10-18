<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Materi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('materi', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('nama',50);
        //     $table->string('keterangan',50);
        //     $table->bool('hapus')->nullable();
        //     $table->timestamp('created_at');
        //     $table->timestamp('updated_at')->nullable();
        //     $table->timestamp('deleted_at')->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('materi');
    }
}
