<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsOnMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->string('ktp_file')->nullable();
            $table->string('foto_file')->nullable();
            $table->string('ijazah_file')->nullable();
            $table->string('skb_file')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('ktp_file');
            $table->dropColumn('foto_file');
            $table->dropColumn('ijazah_file');
            $table->dropColumn('skb_file');
        });
    }
}
