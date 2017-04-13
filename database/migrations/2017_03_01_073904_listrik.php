<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Listrik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listrik', function (Blueprint $table) {
            $table->increments('id');
            $table->string('periode')->nullable();;
            $table->string('id_organisasi')->nullable();;
            $table->string('tahun_bulan')->nullable();;
            $table->text('data');
            $table->text('hasil');
            $table->string('tipe_listrik')->nullable();;
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
        Schema::dropIfExists('listrik');
    }
}
