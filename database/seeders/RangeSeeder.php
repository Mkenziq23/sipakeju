<?php

namespace Database\Seeders;

use App\Models\Range;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RangeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Range::insert([
            [
                'min_value' => 0.2,
                'max_value' => 0.4,
                'keterangan' => 'Kecenderungan Rendah',
            ],
            [
                'min_value' => 0.4,
                'max_value' => 0.8,
                'keterangan' => 'Kecenderungan Sedang',
            ],
            [
                'min_value' => 0.8,
                'max_value' => 1.0,
                'keterangan' => 'Kecenderungan Tinggi',
            ],
        ]);
        // DB::table('range')->insert([
        //     [
        //         'min_value' => 0.2,
        //         'max_value' => 0.4,
        //         'keterangan' => 'Kecenderungan Rendah',
        //     ],
        //     [
        //         'min_value' => 0.4,
        //         'max_value' => 0.8,
        //         'keterangan' => 'Kecenderungan Sedang',
        //     ],
        //     [
        //         'min_value' => 0.8,
        //         'max_value' => 1.0,
        //         'keterangan' => 'Kecenderungan Tinggi',
        //     ],
        // ]);
    }
}
