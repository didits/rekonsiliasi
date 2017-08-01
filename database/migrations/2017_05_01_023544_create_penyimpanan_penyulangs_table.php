<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyimpananPenyulangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('penyimpanan_penyulang');
        Schema::create('penyimpanan_penyulang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_penyulang')->unsigned();
            $table->string('periode');
            $table->text('data');
            $table->text('data_keluar');
            $table->timestamps();
            $table->foreign('id_penyulang')
              ->references('id')->on('penyulang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyimpanan_penyulang');
    }
}
