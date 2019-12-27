<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCertificationInterview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_certification_interview', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('member_certification_id')->nullable();
            $table->unsignedInteger('pertanyaan_lisan_id')->nullable()->comment('Jika metode Asesmen Langsung');
            $table->unsignedInteger('pertanyaan_tertulis_id')->nullable()->comment('Jika metode Asesmen Tidak Langsung');
            $table->text('kesimpulan')->nullable();
            $table->tinyInteger('urutan')->nullable();
            $table->tinyInteger('is_kompeten')->comment('1 = Kompeten, 2 = Tidak Kompeten')->default('0');
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
        Schema::dropIfExists('member_certification_interview');
    }
}
