<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrafoGisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trafo_gi', function (Blueprint $table) {
                $table->increments('id');
//                $table->integer('id_trafo_gi')->unsigned();
                $table->string('nama_trafo_gi');
                $table->string('alamat_trafo_gi');
                $table->text('data_master');
                $table->timestamps();
                $table->foreign('id_organisasi')
                    ->references('id_organisasi')->on('organisasi');
                $table->foreign('id_trafo_gi')
                    ->references('id')->on('gi');});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trafo_gi');
    }
}
