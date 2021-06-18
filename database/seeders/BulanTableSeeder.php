<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BulanTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_bulan')->insert([
            ['bulan' => 'January'],
            ['bulan' => 'February'],
            ['bulan' => 'Maret'],
            ['bulan' => 'April'],
            ['bulan' => 'Mei'],
            ['bulan' => 'Juni'],
            ['bulan' => 'Juli'],
            ['bulan' => 'Agustus'],
            ['bulan' => 'September'],
            ['bulan' => 'Oktober'],
            ['bulan' => 'Novermber'],
            ['bulan' => 'desember'],
        ]);
    }
}
