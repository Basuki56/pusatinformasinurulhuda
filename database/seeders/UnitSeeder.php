<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    public function run()
    {
        DB::table('units')->insert([
            [
                'nama_unit' => 'Unit 1',
                'deskripsi' => 'Deskripsi Unit 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_unit' => 'Unit 2',
                'deskripsi' => 'Deskripsi Unit 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
