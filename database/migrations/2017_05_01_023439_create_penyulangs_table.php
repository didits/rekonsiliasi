<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenyulangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyulang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_gardu')->unsigned();
            $table->string('nama_penyulang');
            $table->string('alamat_penyulang');
            $table->text('data_master');
            $table->timestamps();
            $table->foreign('id_trafo_gi')
                ->references('id_trafo_gi')->on('trafo_gi');
            $table->foreign('id_organisasi')
                ->references('id_organisasi')->on('organisasi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyulang');
    }
}
