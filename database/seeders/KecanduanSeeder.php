<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Penyakit;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KecanduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Penyakit::insert([
            [
                'id' => 'K001',
                'nama' => 'Kecenderungan Rendah',
                'slug' => Str::slug('Kecenderungan Rendah'),
                'deskripsi' => 'Kecenderungan rendah pada perilaku adiktif ...',
                'solusi' => null,
                'gambar' => 'public/assets/gambar/Judi1.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'K002',
                'nama' => 'Kecenderungan Sedang',
                'slug' => Str::slug('Kecenderungan Sedang'),
                'deskripsi' => 'Kecenderungan sedang pada perjudian ...',
                'solusi' => null,
                'gambar' => 'assets/gambar/Judi2.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'id' => 'K003',
                'nama' => 'Kecenderungan Tinggi',
                'slug' => Str::slug('Kecenderungan Tinggi'),
                'deskripsi' => 'Kecenderungan tinggi pada perjudian ...',
                'solusi' => null,
                'gambar' => 'assets/gambar/Judi3.jpeg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
    
}
