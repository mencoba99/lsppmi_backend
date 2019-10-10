<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('program_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_type_id');
            $table->string('code');
            $table->string('name');
            $table->string('description')->nullable();
            $table->jsonb('type'); // {"direct": ["cbt", "int"]} / {"indirect": ["int"]}
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('program_type_id')->references('id')->on('program_type');
        });

        Schema::create('program_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id');
            $table->string('address');
            $table->integer('price');
            $table->integer('participants')->default(1);
            $table->integer('training_duration')->default(1);
            $table->integer('exam_duration')->default(1);
            $table->dateTime('started_at');
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });

        Schema::create('program_units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('is_required')->default(1); // Unit Kompetensi Wajib atau tidak, default wajib
            $table->tinyInteger('type')->default(1); // SKKNI/SI/SK
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
        });

        Schema::create('program_elements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_unit_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('program_unit_id')->references('id')->on('program_units')->onDelete('cascade');
        });

        Schema::create('program_kuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('program_element_id');
            $table->string('code');
            $table->string('name');
            $table->tinyInteger('status')->default(1); // Active/Inactive
            $table->timestamps();

            $table->foreign('program_element_id')->references('id')->on('program_elements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('program_elements');
        Schema::dropIfExists('program_kuk');
        Schema::dropIfExists('program_schedules');
        Schema::dropIfExists('program_units');
        Schema::dropIfExists('programs');
        Schema::dropIfExists('program_type');
    }
}
