<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Diagnosa;
use App\Models\BasisPengetahuan;
use App\Models\Range;
use App\Models\User;
use App\Models\Penyakit;

class DiagnosaSeeder extends Seeder
{
    public function run()
    {
        // Data bobot asli dari masing-masing pengguna (nilai certainty factor input)
        $nilaiAsliNauval = [
            0.2,0.2,0.6,0.6,0.8,0.4,
            0.4,0.4,0.6,0.4,0.4,0.6,
            0.2,0.4,0.4,0.6,0.4,0.4,
            0.6,0.4,0.6,0.4,0.6,0.6,
            0.4,0.4,0.6,0.4,0.6,0.4,
            0.8,0.6,0.4,0.4,0.6,0.6
        ];

        $nilaiAsliDanu = [
            0.8,0.8,0.8,0.6,0.8,0.6,
            0.4,0.6,0.6,0.4,0.4,0.2,
            0.6,0.8,0.6,0.8,0.6,0.6,
            0.6,0.4,0.6,0.2,0.2,0.4,
            0.8,0.4,0.8,0.8,0.8,0.6,
            0.6,0.6,0.4,0.4,0.2,0.4
        ];

        $nilaiAsliYoga = [
            0.2, 0.4, 0.4, 0.6, 0.6, 0.4,
            0.4, 0.4, 0.6, 0.4, 0.4, 0.6,
            0.2, 0.6, 0.6, 0.8, 0.6, 0.2,
            0.8, 0.4, 0.8, 0.4, 0.4, 0.4,
            0.2, 0.4, 0.8, 0.6, 0.6, 0.4,
            0.4, 0.8, 0.6, 0.4, 0.4, 0.4
        ];
        
        $nilaiAsliSepta = [
            0.2, 0.2, 0.2, 0.8, 0.2, 0.4,
            0.8, 0.8, 0.2, 0.8, 0.8, 0.8,
            0.4, 0.2, 0.2, 0.2, 0.8, 0.2,
            0.2, 0.8, 0.8, 0.2, 0.2, 0.2,
            0.8, 0.8, 0.2, 0.2, 0.8, 0.2,
            0.8, 0.8, 0.8, 0.8, 0.8, 0.8
        ];
        $nilaiAsliSepta = [
            0.2, 0.2, 0.2, 0.8, 0.2, 0.4,
            0.8, 0.8, 0.2, 0.8, 0.8, 0.8,
            0.4, 0.2, 0.2, 0.2, 0.8, 0.2,
            0.2, 0.8, 0.8, 0.2, 0.2, 0.2,
            0.8, 0.8, 0.2, 0.2, 0.8, 0.2,
            0.8, 0.8, 0.8, 0.8, 0.8, 0.8
        ];
        $nilaiAsliMisterHan = [
            0.4, 0.4, 0.4, 0.8, 0.6, 0.8, 
            0.2, 0.8, 0.8, 0.4, 0.8, 0.8, 
            0.2, 0.2, 0.2, 0.8, 0.8, 0.8, 
            0.8, 0.8, 0.8, 0.2, 0.6, 0.8, 
            0.2, 0.8, 0.2, 0.8, 0.6, 0.2, 
            0.8, 0.2, 0.8, 0.2, 0.2, 0.8

        ];
        $nilaiAsliYunan = [
            0.4, 0.6, 0.8, 0.4, 0.8, 0.6, 
            0.6, 0.6, 0.4, 0.6, 0.4, 0.6, 
            0.4, 0.6, 0.8, 0.6, 0.6, 0.6, 
            0.6, 0.4, 0.4, 0.2, 0.4, 0.4, 
            0.4, 0.4, 0.4, 0.8, 0.6, 0.6, 
            0.6, 0.6, 0.6, 0.4, 0.4, 0.6
        ];
        
        $nilaiAsliAkbar = [
            0.2, 0.2, 0.2, 0.8, 0.8, 0.8, 
            0.4, 0.8, 0.8, 0.2, 0.2, 0.6, 
            0.2, 0.6, 0.2, 0.4, 0.4, 0.4, 
            0.8, 0.4, 0.8, 0.8, 0.8, 0.4, 
            0.4, 0.2, 0.4, 0.6, 0.6, 0.6, 
            0.8, 0.6, 0.8, 0.4, 0.4, 0.6
        ];
        
        $nilaiAsliJuan = [
            0.6, 0.6, 0.8, 0.4, 0.8, 0.8, 
            0.6, 0.6, 0.4, 0.4, 0.4, 0.4, 
            0.6, 0.4, 0.8, 0.6, 0.6, 0.6, 
            0.6, 0.2, 0.4, 0.4, 0.4, 0.2, 
            0.4, 0.4, 0.4, 0.6, 0.6, 0.4, 
            0.4, 0.4, 0.6, 0.4, 0.4, 0.4
        ];
        
        $nilaiAsliAnanda = [
            0.4, 0.4, 0.6, 0.6, 0.6, 0.6, 
            0.4, 0.6, 0.6, 0.4, 0.6, 0.4, 
            0.4, 0.6, 0.4, 0.6, 0.6, 0.4, 
            0.6, 0.4, 0.6, 0.4, 0.4, 0.4, 
            0.4, 0.6, 0.6, 0.6, 0.6, 0.4, 
            0.4, 0.4, 0.4, 0.4, 0.4, 0.4
        ];
        
        $nilaiAsliHajratul = [
            0.2, 0.8, 0.6, 0.8, 0.6, 0.8, 
            0.6, 0.6, 0.8, 0.2, 0.8, 0.8, 
            0.2, 0.8, 0.4, 0.8, 0.8, 0.4, 
            0.6, 0.8, 0.2, 0.8, 0.8, 0.4, 
            0.4, 0.4, 0.4, 0.8, 0.2, 0.4, 
            0.8, 0.4, 0.6, 0.2, 0.6, 0.4
        ];
        
        $nilaiAsliMia = [
            0.4, 0.6, 0.6, 0.6, 0.6, 0.6, 
            0.6, 0.6, 0.4, 0.4, 0.6, 0.6, 
            0.6, 0.8, 0.6, 0.6, 0.6, 0.6, 
            0.4, 0.4, 0.2, 0.2, 0.4, 0.6, 
            0.4, 0.4, 0.4, 0.8, 0.6, 0.6, 
            0.6, 0.6, 0.2, 0.2, 0.2, 0.2
        ];
        
        $nilaiAsliNovieta = [
            0.6, 0.6, 0.8, 0.6, 0.8, 0.6, 
            0.6, 0.6, 0.4, 0.4, 0.4, 0.4, 
            0.4, 0.4, 0.6, 0.6, 0.6, 0.8, 
            0.4, 0.4, 0.4, 0.6, 0.4, 0.6, 
            0.4, 0.6, 0.4, 0.8, 0.6, 0.6, 
            0.6, 0.4, 0.4, 0.4, 0.6, 0.6
        ];
        
        $nilaiAsliRama = [
            0.4, 0.4, 0.4, 0.4, 0.4, 0.4, 
            0.6, 0.6, 0.6, 0.6, 0.6, 0.6, 
            0.4, 0.4, 0.4, 0.4, 0.4, 0.4, 
            0.6, 0.6, 0.6, 0.6, 0.6, 0.6, 
            0.4, 0.4, 0.4, 0.4, 0.4, 0.4, 
            0.6, 0.6, 0.6, 0.6, 0.6, 0.6
        ];
        $nilaiAsliNaya = [
            0.8,0.8,0.8,0.8,0.8,0.8,0.2,
            0.2,0.8,0.2,0.2,0.2,0.8,0.8,
            0.8,0.8,0.8,0.8,0.2,0.2,0.2,
            0.2,0.2,0.2,0.8,0.8,0.8,0.8,
            0.8,0.8,0.2,0.2,0.2,0.2,0.2,0.2
        ];
        $nilaiAsliIko = [
            0.2,0.2,0.2,0.2,0.2,0.4,0.6,
            0.6,0.6,0.6,0.6,0.6,0.4,0.4,
            0.4,0.4,0.4,0.4,0.6,0.6,0.6,
            0.8,0.8,0.8,0.2,0.2,0.2,0.4,
            0.2,0.4,0.8,0.6,0.8,0.8,0.6,0.8
        ];
        $nilaiAsliSuri = [
            0.6,0.6,0.8,0.4,0.8,0.6,0.4,
            0.6,0.4,0.4,0.4,0.6,0.4,0.6,
            0.6,0.4,0.6,0.6,0.6,0.4,0.6,
            0.4,0.4,0.4,0.2,0.6,0.6,0.6,
            0.6,0.6,0.4,0.4,0.6,0.4,0.4,0.4
        ];
        $nilaiAsliJeje = [
            0.2,0.2,0.2,0.2,0.6,0.2,0.6,
            0.8,0.8,0.8,0.6,0.8,0.2,0.2,
            0.2,0.2,0.6,0.2,0.8,0.6,0.6,
            0.6,0.6,0.6,0.4,0.4,0.4,0.4,
            0.4,0.4,0.6,0.6,0.6,0.6,0.6,0.6
        ];
        $nilaiAsliUlya = [
            0.4,0.6,0.6,0.4,0.6,0.6,0.4,
            0.6,0.6,0.6,0.6,0.6,0.4,0.4,
            0.4,0.4,0.6,0.6,0.6,0.4,0.4,
            0.4,0.6,0.4,0.4,0.4,0.6,0.6,
            0.6,0.4,0.6,0.4,0.6,0.6,0.6,0.6
        ];
        $nilaiAsliLulu = [
            0.2,0.2,0.2,0.2,0.2,0.2,0.8,
            0.8,0.8,0.8,0.8,0.8,0.2,0.2,
            0.2,0.2,0.2,0.2,0.8,0.6,0.6,
            0.6,0.6,0.6,0.4,0.2,0.2,0.4,
            0.2,0.4,0.6,0.6,0.6,0.8,0.6,0.6
        ];
        $nilaiAsliDavid = [
            0.6,0.8,0.6,0.8,0.6,0.8,0.2,
            0.2,0.4,0.4,0.2,0.2,0.6,0.8,
            0.8,0.6,0.8,0.6,0.2,0.2,0.4,
            0.2,0.4,0.4,0.8,0.8,0.6,0.8,
            0.6,0.8,0.2,0.2,0.4,0.4,0.2,0.2
        ];
        $nilaiAsliYudha = [
            0.2,0.2,0.8,0.6,0.8,0.4,0.2,
            0.4,0.8,0.2,0.2,0.4,0.8,0.6,
            0.4,0.8,0.6,0.2,0.4,0.8,0.2,
            0.4,0.4,0.8,0.8,0.4,0.6,0.2,
            0.2,0.6,0.6,0.6,0.4,0.2,0.6,0.8
        ];
        $nilaiAsliNono = [
            0.2,0.2,0.8,0.4,0.8,0.6,0.2,
            0.6,0.6,0.2,0.4,0.4,0.2,0.4,
            0.2,0.6,0.8,0.6,0.8,0.6,0.4,
            0.4,0.4,0.6,0.2,0.6,0.6,0.6,
            0.6,0.6,0.4,0.4,0.6,0.4,0.4,0.6
        ];
        $nilaiAsliAwan = [
            0.2,0.2,0.2,0.6,0.6,0.4,0.6,
            0.4,0.8,0.4,0.6,0.8,0.2,0.2,
            0.2,0.6,0.8,0.4,0.8,0.8,0.8,
            0.6,0.8,0.6,0.2,0.4,0.6,0.2,
            0.6,0.2,0.4,0.8,0.8,0.4,0.4,0.6
        ];
        $nilaiAsliSetya = [
            0.2,0.4,0.4,0.4,0.6,0.6,0.4,
            0.6,0.6,0.4,0.6,0.6,0.2,0.4,
            0.4,0.4,0.6,0.4,0.6,0.6,0.6,
            0.4,0.6,0.6,0.4,0.4,0.6,0.4,
            0.6,0.4,0.6,0.6,0.4,0.4,0.4,0.4
        ];
        // aohdiagdiagdaodgo
        $nilaiAsliPopo = [
            0.4,0.4,0.4,0.4,0.6,0.4,0.4,
            0.6,0.6,0.4,0.6,0.6,0.4,0.4,
            0.4,0.4,0.4,0.4,0.6,0.6,0.6,
            0.4,0.6,0.6,0.4,0.4,0.4,0.4,
            0.4,0.4,0.6,0.6,0.6,0.6,0.6,0.6
        ];
        $nilaiAsliRino = [
            0.4,0.2,0.8,0.4,0.8,0.4,0.4,
            0.4,0.2,0.4,0.4,0.4,0.6,0.4,
            0.6,0.6,0.6,0.6,0.8,0.8,0.4,
            0.4,0.2,0.4,0.4,0.6,0.8,0.4,
            0.6,0.6,0.8,0.6,0.2,0.4,0.8,0.4
        ];
        $nilaiAsliRamadani = [
            0.6,0.8,0.8,0.8,0.8,0.6,0.8,
            0.6,0.8,0.8,0.8,0.6,0.6,0.6,
            0.8,0.8,0.8,0.6,0.8,0.8,0.8,
            0.6,0.8,0.8,0.8,0.6,0.8,0.8,
            0.6,0.4,0.8,0.8,0.8,0.6,0.6,0.6
        ];
        $nilaiAsliTio = [
            0.6,0.6,0.8,0.8,0.8,0.8,0.6,
            0.8,0.8,0.8,0.8,0.8,0.6,0.6,
            0.8,0.8,0.8,0.6,0.8,0.8,0.8,
            0.8,0.8,0.6,0.4,0.6,0.8,0.8,
            0.8,0.4,0.6,0.6,0.8,0.6,0.4,0.8
        ];
        $nilaiAsliSanur = [
            0.8,0.6,0.6,0.8,0.8,0.8,0.8,
            0.6,0.6,0.6,0.6,0.6,0.8,0.6,
            0.8,0.8,0.6,0.4,0.8,0.8,0.8,
            0.8,0.8,0.6,0.6,0.6,0.8,0.8,
            0.8,0.4,0.8,0.4,0.6,0.8,0.4,0.8
        ];
        $nilaiAsliFahri = [
            0.6,0.6,0.6,0.6,0.6,0.6,0.6,
            0.6,0.6,0.6,0.6,0.6,0.6,0.6,
            0.8,0.6,0.8,0.6,0.6,0.6,0.8,
            0.6,0.6,0.6,0.4,0.6,0.6,0.6,
            0.6,0.4,0.6,0.6,0.6,0.6,0.4,0.4
        ];
        $nilaiAsliFajri = [
            0.6,0.2,0.6,0.2,0.6,0.2,0.4,
            0.8,0.2,0.8,0.2,0.8,0.8,0.2,
            0.8,0.4,0.8,0.4,0.2,0.6,0.4,
            0.6,0.4,0.6,0.6,0.4,0.6,0.4,
            0.6,0.4,0.4,0.6,0.4,0.6,0.4,0.6
        ];
        $nilaiAsliZami = [
            0.6,0.6,0.8,0.4,0.8,0.6,0.6,
            0.2,0.2,0.6,0.4,0.2,0.6,0.8,
            0.8,0.8,0.4,0.6,0.4,0.2,0.4,
            0.6,0.6,0.2,0.8,0.4,0.4,0.8,
            0.2,0.8,0.4,0.6,0.2,0.6,0.4,0.2
        ];
        $nilaiAsliAri = [
            0.8,0.8,0.6,0.6,0.8,0.6,0.8,
            0.4,0.2,0.8,0.8,0.4,0.8,0.6,
            0.6,0.8,0.2,0.6,0.2,0.2,0.4,
            0.8,0.4,0.4,0.8,0.2,0.4,0.8,
            0.4,0.8,0.8,0.8,0.4,0.8,0.2,0.4
        ];
        $nilaiAsliSatrio = [
            0.4,0.4,0.6,0.4,0.6,0.4,0.4,
            0.6,0.6,0.6,0.4,0.6,0.4,0.4,
            0.4,0.4,0.8,0.2,0.6,0.6,0.8,
            0.6,0.6,0.6,0.2,0.6,0.8,0.6,
            0.6,0.2,0.4,0.4,0.8,0.6,0.4,0.6
        ];
        $nilaiAsliRamadan = [
            0.4,0.4,0.6,0.4,0.6,0.4,0.4,
            0.6,0.6,0.6,0.4,0.6,0.4,0.4,
            0.4,0.4,0.8,0.2,0.6,0.6,0.8,
            0.6,0.6,0.6,0.2,0.6,0.8,0.6,
            0.6,0.2,0.4,0.4,0.8,0.6,0.4,0.6
        ];
        $nilaiAsliAgus = [
            0.4,0.4,0.6,0.6,0.8,0.2,0.4,
            0.6,0.8,0.8,0.4,0.8,0.2,0.2,
            0.6,0.6,0.6,0.2,0.8,0.4,0.8,
            0.8,0.8,0.8,0.2,0.4,0.6,0.6,
            0.6,0.2,0.6,0.4,0.8,0.8,0.4,0.4
        ];
        $nilaiAsliNaim = [
            0.2,0.6,0.6,0.6,0.8,0.2,0.4,
            0.8,0.8,0.4,0.8,0.8,0.2,0.2,
            0.4,0.6,0.6,0.2,0.8,0.4,0.8,
            0.8,0.8,0.8,0.2,0.4,0.6,0.6,
            0.6,0.2,0.8,0.6,0.4,0.6,0.4,0.4

        ];
        $nilaiAsliFarell = [
            0.4,0.4,0.8,0.6,0.8,0.6,0.4,
            0.4,0.6,0.4,0.2,0.4,0.4,0.6,
            0.4,0.6,0.6,0.4,0.6,0.6,0.8,
            0.4,0.4,0.4,0.4,0.6,0.8,0.6,
            0.6,0.2,0.4,0.4,0.4,0.2,0.2,0.4

        ];
        $nilaiAsliAdzar = [
            0.2,0.6,0.8,0.6,0.8,0.2,0.4,
            0.8,0.4,0.8,0.8,0.8,0.2,0.4,
            0.4,0.4,0.8,0.2,0.4,0.4,0.8,
            0.8,0.6,0.4,0.2,0.6,0.8,0.8,
            0.6,0.2,0.6,0.4,0.4,0.8,0.4,0.4
        ];
        $nilaiAsliAmbon = [
            0.2,0.2,0.8,0.6,0.8,0.2,0.2,
            0.4,0.8,0.4,0.2,0.8,0.2,0.2,
            0.4,0.8,0.8,0.2,0.6,0.8,0.8,
            0.2,0.6,0.8,0.2,0.4,0.8,0.2,
            0.8,0.2,0.4,0.6,0.4,0.4,0.2,0.6

        ];
        $nilaiAsliFuyu = [
            0.4,0.2,0.8,0.6,0.8,0.6,0.4,
            0.6,0.8,0.8,0.6,0.6,0.4,0.4
            ,0.6,0.6,0.6,0.2,0.4,0.4,0.8,
            0.8,0.8,0.8,0.2,0.2,0.8,0.8,
            0.8,0.2,0.6,0.6,0.4,0.6,0.2,0.4

        ];
        $nilaiAsliFuiba = [
            0.6,0.6,0.6,0.6,0.8,0.6,0.4,
            0.6,0.4,0.6,0.6,0.6,0.4,0.4,
            0.6,0.4,0.6,0.4,0.4,0.6,0.6,
            0.4,0.4,0.6,0.4,0.4,0.6,0.6,
            0.6,0.2,0.6,0.6,0.4,0.6,0.4,0.4

        ];
        $nilaiAsliAmboni = [
            0.8,0.8,0.8,0.6,0.8,0.8,0.2,
            0.6,0.4,0.6,0.6,0.6,0.4,0.4,
            0.4,0.6,0.6,0.2,0.4,0.4,0.8,
            0.8,0.8,0.8,0.2,0.2,0.6,0.6,
            0.6,0.4,0.6,0.6,0.6,0.4,0.4,0.4
        ];
        $nilaiAsliMuji = [
            0.4,0.6,0.6,0.6,0.8,0.6,0.4,
            0.4,0.4,0.8,0.6,0.6,0.4,0.4,
            0.4,0.6,0.6,0.4,0.4,0.8,0.8,
            0.8,0.6,0.8,0.2,0.6,0.6,0.8,
            0.6,0.2,0.4,0.4,0.4,0.8,0.4,0.4
        ];
        $nilaiAsliBagus = [
            0.4,0.4,0.2,0.4,0.4,0.4,0.6,
            0.6,0.6,0.6,0.6,0.6,0.4,0.4,
            0.4,0.4,0.4,0.4,0.6,0.6,0.6,
            0.6,0.6,0.6,0.4,0.4,0.4,0.4,
            0.4,0.4,0.6,0.6,0.6,0.6,0.6,0.6
        ];
       
        $nilaiAsliGibran = [
            0.6,0.6,0.8,0.6,0.8,0.6,0.6,
            0.6,0.4,0.4,0.4,0.4,0.6,0.4,
            0.6,0.6,0.4,0.6,0.6,0.4,0.6,
            0.6,0.6,0.4,0.4,0.6,0.4,0.6,
            0.6,0.4,0.4,0.4,0.6,0.4,0.6,0.6
        ];
        $nilaiAsliGege = [
            0.8,0.8,0.8,0.4,0.8,0.8,0.2,
            0.6,0.2,0.6,0.2,0.2,0.4,0.8,
            0.8,0.8,0.8,0.8,0.2,0.2,0.8,
            0.2,0.6,0.2,0.4,0.8,0.6,0.8,
            0.4,0.4,0.6,0.2,0.8,0.6,0.2,0.4
        ];
        $nilaiAsliKafa = [
            0.2,0.2,0.2,0.2,0.6,0.2,0.8,
            0.8,0.8,0.8,0.8,0.8,0.2,0.2,
            0.2,0.2,0.2,0.2,0.8,0.4,0.6,
            0.4,0.6,0.6,0.4,0.4,0.6,0.4,
            0.6,0.4,0.8,0.6,0.4,0.4,0.2,0.6
        ];
        $nilaiAsliFebri = [
            0.4,0.4,0.6,0.6,0.6,0.6,0.4,
            0.6,0.6,0.4,0.4,0.4,0.4,0.6,
            0.4,0.6,0.6,0.4,0.6,0.4,0.4,
            0.4,0.6,0.4,0.4,0.6,0.6,0.6,
            0.6,0.4,0.4,0.4,0.4,0.4,0.4,0.4
        ];
        $nilaiAsliLiana = [
            0,0.2,0,0.2,0,0,0.8,0,0.8,0,
            0.8,0,0,0,0.4,0.4,0,0.2,0.6,
            0,0.6,0,0,0.8,0,0,0,0.2,0.2,
            0,0,0,0.8,0,0,0
        ];
        $nilaiAsliBionen = [
            0.4,0.8,0.8,0.6,0.8,0.8,0.4,
            0.6,0.4,0.2,0.2,0.4,0.4,0.4,
            0.6,0.6,0.8,0.8,0.6,0.2,0.6,
            0.6,0.2,0.6,0.4,0.6,0.6,0.6,
            0.8,0.6,0.6,0.4,0.6,0.4,0.4,0.4
        ];
        $nilaiAsliReza = [
            0,0,0.2,0.2,0,0,0,0,0.8,0,0,
            0,0,0,0.2,0.2,0,0.2,0.8,0.8,
            0.8,0.8,0.8,0,0,0.2,0.2,0.4,
            0.4,0.4,0.6,0.6,0,0,0.6,0.6
        ];
        $nilaiAsliSadad = [
            0.4,0.4,0.6,0.8,0.8,0.6,0.6,
            0.6,0.4,0.4,0.2,0.6,0.4,0.4,
            0.4,0.6,0.8,0.6,0.6,0.6,0.6,
            0.6,0.6,0.6,0.4,0.6,0.6,0.8,
            0.6,0.4,0.6,0.6,0.6,0.4,0.4,0.6
        ];
        $nilaiAsliRico = [
            0.2,0.2,0.4,0.6,0.8,0.2,0.4,
            0.4,0.6,0.4,0.4,0.4,0.2,0.6,
            0.4,0.4,0.6,0.2,0.8,0.6,0.8,
            0.4,0.4,0.6,0.2,0.6,0.6,0.6,
            0.8,0.2,0.4,0.4,0.8,0.4,0.4,0.4
        ];

        // Nomor gejala yang dianggap "unfavorable" (negatif)
        $unfavorableNos = array_merge(
            range(7, 12),
            range(19, 24),
            range(31, 36)
        );

        // Bobot untuk nilai favorable (positif) dan unfavorable (negatif)
        $arbobotFavorable = [0 => 0.2, 1 => 0.4, 2 => 0.6, 3 => 0.8, 4 => 0.0];
        $arbobotUnfavorable = [0 => 0.8, 1 => 0.6, 2 => 0.4, 3 => 0.2, 4 => 0.0];

        // Fungsi untuk mapping nilai ke index bobot
        $mapNilaiKeIndex = function ($nilai, $isUnfavorable) use ($arbobotFavorable, $arbobotUnfavorable) {
            $arr = $isUnfavorable ? $arbobotUnfavorable : $arbobotFavorable;
            foreach ($arr as $index => $val) {
                if (abs($val - $nilai) < 0.001) {
                    return $index;
                }
            }
            return 4; // default indeks 4 untuk 'Tidak Tahu' (0.0)
        };

        // Label confidence sesuai index bobot
        $confidenceLabels = [
            'Sangat Tidak Setuju',
            'Tidak Setuju',
            'Setuju',
            'Sangat Setuju',
            'Tidak Tahu'
        ];

        // Ambil semua basis pengetahuan dengan relasi gejala
        $basisPengetahuans = BasisPengetahuan::with('gejala')->get();

        // Fungsi untuk memproses data diagnosa
        $processData = function($nilaiAsli, $nama, $noHp, $alamat, $pakar, $namaUser) use (
            $unfavorableNos, $mapNilaiKeIndex, $arbobotFavorable, $arbobotUnfavorable,
            $confidenceLabels, $basisPengetahuans
        ) {
            $kepastian = [];
            $cfHasil = [];

            // Iterasi tiap nilai bobot
            foreach ($nilaiAsli as $index => $nilai) {
                $no = $index + 1;
                $isUnfavorable = in_array($no, $unfavorableNos);
                $idxBobot = $mapNilaiKeIndex($nilai, $isUnfavorable);
                $value = $isUnfavorable ? $arbobotUnfavorable[$idxBobot] : $arbobotFavorable[$idxBobot];
                $label = $confidenceLabels[$idxBobot];
                $gejalaId = "P" . str_pad($no, 3, "0", STR_PAD_LEFT);

                $kepastian[$gejalaId] = [
                    'value' => $value,
                    'label' => $label,
                ];

                // Cari basis pengetahuan sesuai gejala
                $basis = $basisPengetahuans->firstWhere('gejala_id', $gejalaId);
                if ($basis) {
                    $cfHasil[] = $basis->cf * $value;
                }
            }

            // Fungsi gabung nilai CF sesuai metode Certainty Factor
            $combineCF = function (array $cfValues, array $gejalaIds) {
                $cfCombine = array_shift($cfValues);

                $unfavorableGejalaIds = [
                    'P007', 'P008', 'P009', 'P010', 'P011', 'P012',
                    'P019', 'P020', 'P021', 'P022', 'P023', 'P024',
                    'P031', 'P032', 'P033', 'P034', 'P035', 'P036'
                ];

                foreach ($cfValues as $key => $cf) {
                    $gejalaId = $gejalaIds[$key];

                    if (in_array($gejalaId, $unfavorableGejalaIds)) {
                        $cfCombine = abs($cfCombine - ($cf * (1 - $cfCombine)));
                    } else {
                        $cfCombine = abs($cfCombine + ($cf * (1 - $cfCombine)));
                    }
                }
                return $cfCombine;
            };

            $gejalaIds = array_keys($kepastian);
            $cfCombine = $combineCF($cfHasil, $gejalaIds);

            // Cari range sesuai hasil CF
            $range = Range::where('min_value', '<=', $cfCombine)
                          ->where('max_value', '>=', $cfCombine)
                          ->first();

            $tingkatKecenderungan = $range ? $range->keterangan : 'Tidak Kecenderungan';

            // Cari penyakit berdasar keterangan tingkat kecenderungan
            $penyakit = Penyakit::where('nama', 'like', '%' . $tingkatKecenderungan . '%')->first();

            // Cari user berdasarkan nama
            $user = User::where('name', $namaUser)->first();

            // Simpan diagnosa ke database
            Diagnosa::create([
                'user_id' => $user ? $user->id : null,
                'nama' => $nama,
                'no_hp' => $noHp,
                'alamat' => $alamat,
                'pakar' => $pakar,
                'deskripsi' => $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.',
                'solusi' => $penyakit ? $penyakit->solusi : 'Tidak ada solusi terkait.',
                'kondisi' => json_encode($kepastian),
                'tingkat_kecenderungan' => $tingkatKecenderungan,
                'presentase' => number_format($cfCombine * 100, 2),
            ]);
        };

        // Contoh pemanggilan untuk beberapa user
        $processData($nilaiAsliNauval, 'Nauval Arif', '081234567800', 'Jl. Mawar No. 1', 'Panca Kursistin Handayani, S.Psi., MA', 'Nauval Arif');
        $processData($nilaiAsliDanu, 'Danu Ahmad Maulana', '081234567801', 'Jl. Mawar No. 2', 'Panca Kursistin Handayani, S.Psi., MA', 'Danu Ahmad Maulana');
        $processData($nilaiAsliYoga, 'Mochamad Yoga Kurniawan', '081234567802', 'Jl. Mawar No. 3', 'Panca Kursistin Handayani, S.Psi., MA', 'Mochamad Yoga Kurniawan');
        $processData($nilaiAsliSepta, 'Septa Daeng Indar Kurniawan', '081234567803', 'Jl. Mawar No. 4', 'Panca Kursistin Handayani, S.Psi., MA', 'Septa Daeng Indar Kurniawan');
        $processData($nilaiAsliMisterHan, 'Mister Han', '081234567804', 'Jl. Mawar No. 5', 'Panca Kursistin Handayani, S.Psi., MA', 'Mister Han');
        $processData($nilaiAsliYunan, 'Yunan', '081234567806', 'Jl. Mawar No. 7', 'Panca Kursistin Handayani, S.Psi., MA', 'Yunan');
        $processData($nilaiAsliAkbar, 'Muhammad Maulana Akbar', '081234567807', 'Jl. Mawar No. 8', 'Panca Kursistin Handayani, S.Psi., MA', 'Muhammad Maulana Akbar');
        $processData($nilaiAsliJuan, 'Juan', '081234567808', 'Jl. Mawar No. 9', 'Panca Kursistin Handayani, S.Psi., MA', 'Juan');
        $processData($nilaiAsliAnanda, 'Ananda Putri', '081234567809', 'Jl. Mawar No. 10', 'Panca Kursistin Handayani, S.Psi., MA', 'Ananda Putri');
        $processData($nilaiAsliHajratul, 'Hajratul Aulia', '081234567810', 'Jl. Mawar No. 11', 'Panca Kursistin Handayani, S.Psi., MA', 'Hajratul Aulia');
        $processData($nilaiAsliMia, 'Mia', '081234567811', 'Jl. Mawar No. 12', 'Panca Kursistin Handayani, S.Psi., MA', 'Mia');
        $processData($nilaiAsliNovieta, 'Novieta Ismiyanti', '081234567812', 'Jl. Mawar No. 13', 'Panca Kursistin Handayani, S.Psi., MA', 'Novieta Ismiyanti');
        $processData($nilaiAsliRama, 'Rama', '081234567813', 'Jl. Mawar No. 14', 'Panca Kursistin Handayani, S.Psi., MA', 'Rama');
        $processData($nilaiAsliNaya, 'Naya', '081234567814', 'Jl. Mawar No. 15', 'Panca Kursistin Handayani, S.Psi., MA', 'Naya');
        $processData($nilaiAsliIko, 'Iko Raga', '081234567815', 'Jl. Mawar No. 16', 'Panca Kursistin Handayani, S.Psi., MA', 'Iko Raga');
        $processData($nilaiAsliSuri, 'Suri Aridarma', '081234567816', 'Jl. Mawar No. 17', 'Panca Kursistin Handayani, S.Psi., MA', 'Suri Aridarma');
        $processData($nilaiAsliJeje, 'Jeje', '081234567817', 'Jl. Mawar No. 18', 'Panca Kursistin Handayani, S.Psi., MA', 'Jeje');
        $processData($nilaiAsliUlya, 'Ulya', '081234567818', 'Jl. Mawar No. 19', 'Panca Kursistin Handayani, S.Psi., MA', 'Ulya');
        $processData($nilaiAsliLulu, 'Lulu', '081234567819', 'Jl. Mawar No. 20', 'Panca Kursistin Handayani, S.Psi., MA', 'Lulu');
        $processData($nilaiAsliDavid, 'David', '081234567820', 'Jl. Mawar No. 21', 'Panca Kursistin Handayani, S.Psi., MA', 'David');
        $processData($nilaiAsliYudha, 'Yudha', '081234567821', 'Jl. Mawar No. 22', 'Panca Kursistin Handayani, S.Psi., MA', 'Yudha');
        $processData($nilaiAsliNono, 'Nono', '081234567822', 'Jl. Mawar No. 23', 'Panca Kursistin Handayani, S.Psi., MA', 'Nono');
        $processData($nilaiAsliAwan, 'Awan', '081234567823', 'Jl. Mawar No. 24', 'Panca Kursistin Handayani, S.Psi., MA', 'Awan');
        $processData($nilaiAsliPopo, 'Popo', '081234567825', 'Jl. Mawar No. 26', 'Panca Kursistin Handayani, S.Psi., MA', 'Popo');
        $processData($nilaiAsliSetya, 'Setya', '081234567824', 'Jl. Mawar No. 25', 'Panca Kursistin Handayani, S.Psi., MA', 'Setya');
        $processData($nilaiAsliRino, 'Rino', '081234567826', 'Jl. Mawar No. 27', 'Panca Kursistin Handayani, S.Psi., MA', 'Rino');
        $processData($nilaiAsliRamadani, 'Ramadani', '081234567827', 'Jl. Mawar No. 28', 'Panca Kursistin Handayani, S.Psi., MA', 'Ramadani');
        $processData($nilaiAsliTio, 'Tio', '081234567828', 'Jl. Mawar No. 29', 'Panca Kursistin Handayani, S.Psi., MA', 'Tio');
        $processData($nilaiAsliSanur, 'SANUR', '081234567829', 'Jl. Mawar No. 30', 'Panca Kursistin Handayani, S.Psi., MA', 'SANUR');
        $processData($nilaiAsliFahri, 'Fahri', '081234567830', 'Jl. Mawar No. 31', 'Panca Kursistin Handayani, S.Psi., MA', 'Fahri');
        $processData($nilaiAsliFajri, 'Fajri', '081234567831', 'Jl. Mawar No. 32', 'Panca Kursistin Handayani, S.Psi., MA', 'Fajri');
        $processData($nilaiAsliZami, 'Zami', '081234567832', 'Jl. Mawar No. 33', 'Panca Kursistin Handayani, S.Psi., MA', 'Zami');
        $processData($nilaiAsliAri, 'Ari', '081234567833', 'Jl. Mawar No. 34', 'Panca Kursistin Handayani, S.Psi., MA', 'Ari');
        $processData($nilaiAsliSatrio, 'Satrio', '081234567834', 'Jl. Mawar No. 35', 'Panca Kursistin Handayani, S.Psi., MA', 'Satrio');
        $processData($nilaiAsliRamadan, 'Ramadan', '081234567835', 'Jl. Mawar No. 36', 'Panca Kursistin Handayani, S.Psi., MA', 'Ramadan');
        $processData($nilaiAsliAgus, 'Agus', '081234567836', 'Jl. Mawar No. 37', 'Panca Kursistin Handayani, S.Psi., MA', 'Agus');
        $processData($nilaiAsliNaim, 'Naim', '081234567837', 'Jl. Mawar No. 38', 'Panca Kursistin Handayani, S.Psi., MA', 'Naim');
        $processData($nilaiAsliFarell, 'Farell', '081234567838', 'Jl. Mawar No. 39', 'Panca Kursistin Handayani, S.Psi., MA', 'Farell');
        $processData($nilaiAsliAdzar, 'Adzar Aldante', '081234567839', 'Jl. Mawar No. 40', 'Panca Kursistin Handayani, S.Psi., MA', 'Adzar Aldante');
        $processData($nilaiAsliAmbon, 'Ambon', '081234567840', 'Jl. Mawar No. 41', 'Panca Kursistin Handayani, S.Psi., MA', 'Ambon');
        $processData($nilaiAsliFuyu, 'Fuyu', '081234567841', 'Jl. Mawar No. 42', 'Panca Kursistin Handayani, S.Psi., MA', 'Fuyu');
        $processData($nilaiAsliFuiba, 'Fuiba', '081234567842', 'Jl. Mawar No. 43', 'Panca Kursistin Handayani, S.Psi., MA', 'Fuiba');
        $processData($nilaiAsliAmboni, 'Amboni', '081234567843', 'Jl. Mawar No. 44', 'Panca Kursistin Handayani, S.Psi., MA', 'Amboni');
        $processData($nilaiAsliMuji, 'Muji', '081234567844', 'Jl. Mawar No. 45', 'Panca Kursistin Handayani, S.Psi., MA', 'Muji');
        $processData($nilaiAsliBagus, 'Bagus Prasetyo', '081234567844', 'Jl. Mawar No. 46', 'Panca Kursistin Handayani, S.Psi., MA', 'Bagus Prasetyo');
        $processData($nilaiAsliGibran, 'Gibran', '081234567844', 'Jl. Mawar No. 48', 'Panca Kursistin Handayani, S.Psi., MA', 'Gibran');
        $processData($nilaiAsliGege, 'Gege', '081234567844', 'Jl. Mawar No. 49', 'Panca Kursistin Handayani, S.Psi., MA', 'Gege');
        $processData($nilaiAsliKafa, 'Kafa', '081234567844', 'Jl. Mawar No. 50', 'Panca Kursistin Handayani, S.Psi., MA', 'Kafa');
        $processData($nilaiAsliFebri, 'Febri', '081234567844', 'Jl. Mawar No. 51', 'Panca Kursistin Handayani, S.Psi., MA', 'Febri');
        $processData($nilaiAsliLiana, 'Liana', '081234567844', 'Jl. Mawar No. 52', 'Panca Kursistin Handayani, S.Psi., MA', 'Liana');
        $processData($nilaiAsliBionen, 'Bionen', '081234567844', 'Jl. Mawar No. 53', 'Panca Kursistin Handayani, S.Psi., MA', 'Bionen');
        $processData($nilaiAsliReza, 'Reza', '081234567844', 'Jl. Mawar No. 55', 'Panca Kursistin Handayani, S.Psi., MA', 'Reza');
        $processData($nilaiAsliSadad, 'Sadad', '081234567844', 'Jl. Mawar No. 56', 'Panca Kursistin Handayani, S.Psi., MA', 'Sadad');
        $processData($nilaiAsliRico, 'Rico', '081234567844', 'Jl. Mawar No. 57', 'Panca Kursistin Handayani, S.Psi., MA', 'Rico');
        


        // Tambahkan panggilan $processData untuk pengguna lain jika perlu...
    }
}
