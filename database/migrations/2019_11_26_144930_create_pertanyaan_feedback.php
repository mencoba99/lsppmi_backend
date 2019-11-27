<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePertanyaanFeedback extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question')->comment('Isian Pertanyaan');
            $table->tinyInteger('ordering')->comment('Untuk urutan dimunculkan di Formnya');
            $table->boolean('status')->default(true)->comment('Untuk status pertanyaan : True/False');
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
        Schema::dropIfExists('feedback_question');
    }
}
