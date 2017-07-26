<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gi', function (Blueprint $table) {
           $table->increments('id');
           $table->string('nama_gi');
           $table->integer('id_organisasi')->unsigned();
           $table->string('alamat_gi');
           $table->text('data_master');
           $table->timestamps();
           $table->foreign('id_organisasi')
           ->references('id')->on('organisasi');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gi');
    }
}
