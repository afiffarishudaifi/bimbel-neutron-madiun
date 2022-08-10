<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('kelas_id');
			$table->foreign('kelas_id')->references('id')->on('kelas');
			$table->unsignedBigInteger('mapel_id');
			$table->foreign('mapel_id')->references('id')->on('mapels');
			$table->string('title',255)->nullable();
			$table->longText('desc')->nullable();
			$table->unsignedBigInteger('pengajar_id');
			$table->foreign('pengajar_id')->references('id')->on('pengajars');

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
        Schema::dropIfExists('topic');
    }
}
