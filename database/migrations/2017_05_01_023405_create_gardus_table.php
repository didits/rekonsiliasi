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
        Schema::create('gardu', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_organisasi');
            $table->string('nama_gardu');
            $table->string('alamat_gardu');
            $table->text('data_master');
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
        Schema::dropIfExists('gardu');
    }
}
