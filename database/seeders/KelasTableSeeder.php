<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mst_kelas')->insert([
            ['kelas' => 'X'],
            ['kelas' => 'XI'],
            ['kelas' => 'XII']
        ]);
    }
}
