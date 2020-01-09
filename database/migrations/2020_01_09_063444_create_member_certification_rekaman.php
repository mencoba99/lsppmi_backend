<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCertificationRekaman extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_certification_rekaman', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_certification_id')->nullable();
            $table->boolean('rekomendasi_asesor')->comment('Hasil rekomendasi Asesor : True = Kompeten, False = Belum Kompeten');
            $table->jsonb('tindak_lanjut')->comment('Untuk Kolom Tindak Lanjut [{"tindak_lanjut":1,"kompetensi_elemen":{1,2,3},"kompetensi_kuk"}]');
            $table->jsonb('komentar_asesor')->comment('Untuk Kolom Tindak Lanjut [{"tindak_lanjut":1,"kompetensi_elemen":{1,2,3},"kompetensi_kuk"}]');
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
        Schema::dropIfExists('member_certification_rekaman');
    }
}
