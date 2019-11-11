<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberCertificationPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_certification_payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('member_certification_id');
            $table->string('account_no');
            $table->string('account_name');
            $table->string('payment_file');
            $table->dateTime('transfer_date');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_certification_payments');
    }
}
