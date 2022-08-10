<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatervideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matervideos', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('mapel_id');
            $table->foreign('mapel_id')->references('id')->on('mapels');
			$table->string('link_embed',255)->nullable();
			$table->integer('no_urut')->nullable()->default(0);
			$table->string('nama_materivideo',255)->nullable();
			$table->unsignedBigInteger('entitas_id');
            $table->foreign('entitas_id')->references('id')->on('entitas');

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
        Schema::dropIfExists('matervideo');
    }
}
