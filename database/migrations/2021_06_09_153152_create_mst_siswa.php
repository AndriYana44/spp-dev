<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nis');
            $table->string('nisn')->unique();
            $table->string('kelas');
            $table->string('jk');
            $table->string('tgl_lahir');
            $table->boolean('is_deleted')->default(0);
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
        Schema::dropIfExists('mst_siswa');
    }
}
