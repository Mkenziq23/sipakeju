<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\admin\AdminController;
use App\Http\Requests\admin\LaporanRequest;
use App\Models\Diagnosa;
use App\Models\Gejala;
use PDF;

class LaporanController extends AdminController
{
    public function index(LaporanRequest $request)
    {
        $awal = $request->periode_awal;
        $akhir = $request->periode_akhir;

        // Get all diagnoses within the selected period
        $diagnosa = Diagnosa::whereBetween('created_at', [$awal . ' 00:00:00', $akhir . ' 23:59:59'])->get(); 
        $judul = "Laporan Identifikasi Kecenderungan Perilaku Judi Online";
        $awalPeriode = date('d-m-Y', strtotime($awal));
        $akhirPeriode = date('d-m-Y', strtotime($akhir));

        // Ensure data is available
        $gejala = Gejala::all();

        // Generate PDF
        $pdf = PDF::loadView('admin.diagnosa.laporan', compact(
            'diagnosa', 'judul', 'awalPeriode', 'akhirPeriode', 'gejala'
        ))->setPaper('a4', 'portrait');

        return $pdf->stream();
    }
}

