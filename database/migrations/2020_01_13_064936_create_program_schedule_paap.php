<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramSchedulePaap extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_schedule_paap', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('program_schedule_id')->nullable();
            $table->jsonb('pa_asesi')->nullable()->comment('Untuk Pendekatan Asesmen > Asesi');
            $table->tinyInteger('pa_tujuan_asesmen')->nullable()->comment('Untuk Pendekatan Asesmen > Tujuan Asesmen');
            $table->jsonb('pa_konteks_asesmen')->nullable()->comment('Untuk Pendekatan Asesmen > Konteks Asesmen');
            $table->jsonb('pa_orang_relevan')->nullable()->comment('Untuk Pendekatan Asesmen > Orang yang relevan untuk dikonfirmasi');
            $table->tinyInteger('pa_tolak_ukur')->nullable()->comment('Untuk Pendekatan Asesmen > Tolak ukur Asesmen');
            $table->tinyInteger('metode_asesmen')->nullable()->comment('Untuk pilihan metode asesmen yang akan digunakan : 1 = Langsung ; 2 = Tidak Langsung ; 3 = Tidak ada metode');
            $table->text('mk_1')->nullable()->comment('Untuk Modifikasi dan Kontektualisasi pertanyaan 1');
            $table->text('mk_2')->nullable()->comment('Untuk Modifikasi dan Kontektualisasi pertanyaan 2');
            $table->text('mk_3')->nullable()->comment('Untuk Modifikasi dan Kontektualisasi pertanyaan 3');
            $table->text('mk_4')->nullable()->comment('Untuk Modifikasi dan Kontektualisasi pertanyaan 4');
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
        Schema::dropIfExists('program_schedule_paap');
    }
}
