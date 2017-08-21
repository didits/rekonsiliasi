<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGardusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('gi');
        Schema::create('gi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organisasi')->unsigned();
            $table->string('nama_gi');
            $table->string('alamat_gi');
            $table->text('data_master');
            $table->timestamps();
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi');
        });

        Schema::dropIfExists('trafo_gi');
        Schema::create('trafo_gi', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organisasi')->unsigned();
            $table->integer('id_gi')->unsigned();
            $table->string('nama_trafo_gi');
            $table->string('alamat_trafo_gi');
            $table->text('data_master');
            $table->timestamps();
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi');
            $table->foreign('id_gi')
                ->references('id')
                ->on('gi');
        });

        Schema::dropIfExists('penyulang');
        Schema::create('penyulang', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organisasi')->unsigned();
            $table->integer('id_trafo_gi')->unsigned();
            $table->string('nama_penyulang');
            $table->string('alamat_penyulang');
            $table->text('data_master');
            $table->timestamps();
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi');
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi');
        });

        Schema::dropIfExists('gardu');
        Schema::create('gardu', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organisasi')->unsigned();
            $table->integer('id_penyulang')->unsigned();
            $table->integer('tipe_gardu');
            $table->string('nama_gardu');
            $table->string('alamat_gardu');
            $table->text('data_master');
            $table->timestamps();
            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi');
            $table->foreign('id_penyulang')
                ->references('id')
                ->on('penyulang');
        });

        Schema::dropIfExists('transfer');
        Schema::create('transfer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_organisasi')->unsigned();
            $table->integer('id_gi')->unsigned();
            $table->integer('id_trafo_gi')->unsigned();
            $table->integer('id_penyulang')->unsigned();
            $table->timestamps();

            $table->foreign('id_organisasi')
                ->references('id')
                ->on('organisasi');
            $table->foreign('id_gi')
                ->references('id')
                ->on('gi');
            $table->foreign('id_trafo_gi')
                ->references('id')
                ->on('trafo_gi');
            $table->foreign('id_penyulang')
                ->references('id')
                ->on('penyulang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gardu');
        Schema::dropIfExists('penyulang');
        Schema::dropIfExists('trafo_gi');
        Schema::dropIfExists('gi');
        Schema::dropIfExists('transfer');
    }
}
