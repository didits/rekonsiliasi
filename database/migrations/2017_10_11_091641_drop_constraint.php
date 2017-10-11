<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropConstraint extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gi', function (Blueprint $table) {
            $table->dropForeign('gi_id_organisasi_foreign');
        });

        Schema::table('trafo_gi', function (Blueprint $table) {
            $table->dropForeign('trafo_gi_id_organisasi_foreign');
            $table->dropForeign('trafo_gi_id_gi_foreign');
        });

        Schema::table('penyulang', function (Blueprint $table) {
            $table->dropForeign('penyulang_id_organisasi_foreign');
            $table->dropForeign('penyulang_id_trafo_gi_foreign');
        });

        Schema::table('gardu', function (Blueprint $table) {
            $table->dropForeign('gardu_id_organisasi_foreign');
            $table->dropForeign('gardu_id_penyulang_foreign');
        });

        Schema::table('transfer', function (Blueprint $table) {
            $table->dropForeign('transfer_id_gi_foreign');
            $table->dropForeign('transfer_id_organisasi_foreign');
            $table->dropForeign('transfer_id_penyulang_foreign');
            $table->dropForeign('transfer_id_trafo_gi_foreign');
        });

        Schema::table('penyimpanan_gardu', function (Blueprint $table) {
            $table->dropForeign('penyimpanan_gardu_id_gardu_foreign');
        });

        Schema::table('penyimpanan_penyulang', function (Blueprint $table) {
            $table->dropForeign('penyimpanan_penyulang_id_penyulang_foreign');
        });

        Schema::table('penyimpanan_trafo_gi', function (Blueprint $table) {
            $table->dropForeign('penyimpanan_trafo_gi_id_trafo_gi_foreign');
        });

        Schema::table('penyimpanan_gi', function (Blueprint $table) {
            $table->dropForeign('penyimpanan_gi_id_gi_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
