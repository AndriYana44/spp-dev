<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditTrsTransaksiSpp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trs_transaksi_spp', function (Blueprint $table) {
            $table->renameColumn('tahun', 'id_tahun');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trs_transaksi_spp', function (Blueprint $table) {
            $table->renameColumn('id_tahun', 'tahun');
        });
    }
}
