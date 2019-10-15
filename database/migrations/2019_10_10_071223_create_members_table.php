<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('token');
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->string('identity_no')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->tinyInteger('gender')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('handphone')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('education')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_position')->nullable();
            $table->string('company_address')->nullable();
            $table->string('company_postal_code')->nullable();
            $table->string('company_phone')->nullable();
            $table->string('company_fax')->nullable();
            $table->string('company_email')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->dateTime('verified_at')->nullable();
            $table->timestamps();
        });

        Schema::create('member_certification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('program_schedule_id');
            $table->tinyInteger('payment_method_id')->default(1); // Default 1 = Bank Transfer
            $table->tinyInteger('payment_file')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('program_schedule_id')->references('id')->on('program_schedules');
        });

        Schema::create('member_certification_approval', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_certification_id');
            $table->integer('user_id');
            $table->tinyInteger('type')->default(1); // 1 = Approve/Verify/Rekomendasi, 0 = Reject/Tidak Rekomen
            $table->enum('form', ['apl_01', 'apl_02'])->default('apl_01');
            $table->string('message')->nullable();
            $table->timestamps();

            $table->foreign('member_certification_id')->references('id')->on('member_certification');
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('member_certification_apl_01', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('program_competence_unit_id');
            $table->string('proof')->nullable(); // Bukti
            $table->tinyInteger('status')->default(1); // 1 = Memenuhi Syarat, 0 = Tidak memenuhi syarat
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('program_competence_unit_id')->references('id')->on('program_competence_unit');
        });

        Schema::create('member_certification_apl_02', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_id');
            $table->integer('competence_kuk_id');
            $table->tinyInteger('is_competent')->default(1); // 1 = Kompeten, 0 = Belum Kompeten
            $table->string('proof')->nullable(); // Bukti
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('competence_kuk_id')->references('id')->on('competence_kuk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_certification_approval');
        Schema::dropIfExists('member_certification_apl_01');
        Schema::dropIfExists('member_certification_apl_02');
        Schema::dropIfExists('member_certification');
        Schema::dropIfExists('members');
    }
}
