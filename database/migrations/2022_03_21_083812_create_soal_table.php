<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soals', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('groupsoal_id');
			$table->foreign('groupsoal_id')->references('id')->on('groupsoals');
			$table->longText('uraian')->nullable();
			$table->string('gambar',255)->nullable();
			$table->string('opsia',255)->nullable();
			$table->string('opsib',255)->nullable();
			$table->string('opsic',255)->nullable();
			$table->string('opsid',255)->nullable();
			$table->string('opsie',255)->nullable();
			$table->enum('kunci',['a','b','c','d','e'])->nullable()->default('a');

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
        Schema::dropIfExists('soal');
    }
}
