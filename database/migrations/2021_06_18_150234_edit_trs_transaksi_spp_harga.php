<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTrsTransaksiSppHarga extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trs_transaksi_spp_harga', function(Blueprint $table) {
            $table->integer('id_bulan');
            $table->integer('id_tahun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trs_transaksi_spp_harga', function(Blueprint $table) {
            $table->dropColumn('id_bulan');
            $table->dropColumn('id_tahun');
        });
    }
}
