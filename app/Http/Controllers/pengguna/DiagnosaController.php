<?php

namespace App\Http\Controllers\pengguna;

use App\Http\Controllers\pengguna\PenggunaController;
use App\Models\Diagnosa;
use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\BasisPengetahuan;

class DiagnosaController extends PenggunaController
{
    public $title = "Identifikasi";

    public function index()
    {
        $title = $this->title;
        $bcrum = $this->bcrum('Diagnosa');
        $gejalas = Gejala::all();
        return view('pengguna.diagnosa.index', compact('title', 'bcrum', 'gejalas'));
    }

public function analisa(Request $request)
{
    $arbobotFavorable = [
        0 => 0.2, // Sangat Tidak Setuju
        1 => 0.4, // Tidak Setuju
        2 => 0.6, // Setuju
        3 => 0.8  // Sangat Setuju
    ]; // Bobot favorable

    $arbobotUnfavorable = [
        0 => 0.8, // Sangat Tidak Setuju
        1 => 0.6, // Tidak Setuju
        2 => 0.4, // Setuju
        3 => 0.2  // Sangat Setuju
    ]; // Bobot unfavorable

    $confidenceLabels = [
        'Sangat Tidak Setuju',
        'Tidak Setuju',
        'Setuju',
        'Sangat Setuju'
    ];

     $unfavorableIds = [
            'P007', 'P008', 'P009', 'P010', 'P011', 'P012', 'P019', 'P020', 'P021', 'P022',
            'P023', 'P024', 'P031', 'P032', 'P033', 'P034', 'P035', 'P036'
        ]; // Unfavorable IDs

    $kepastian = []; // Array for user's CF values
    $cfHasil = []; // Array for CF calculations

    // Process user input confidence
    foreach ($request->kondisi as $kondisiItem) {
        // Pisahkan ID gejala dan nilai bobot
        $arkondisi = explode("_", $kondisiItem);

        // Pastikan data yang diterima valid
        if (isset($arkondisi[0]) && isset($arkondisi[1])) {
            // Ambil ID gejala dan nilai bobot
            $gejalaId = $arkondisi[0];
            $bobot = (int)$arkondisi[1]; // Ubah ke integer untuk memetakan nilai yang benar

            // Tentukan apakah gejala ini termasuk dalam kategori unfavorable atau favorable
            if (in_array($gejalaId, $unfavorableIds)) {
                // Unfavorable
                $value = $arbobotUnfavorable[$bobot]; // Unfavorable adjustment
            } else {
                // Favorable
                $value = $arbobotFavorable[$bobot]; // Favorable adjustment
            }
            

            // Tentukan label berdasarkan bobot inputan
            $label = $confidenceLabels[$bobot]; // Menentukan label sesuai bobot yang dipilih

            // Simpan nilai dan label ke dalam array $kepastian
            $kepastian[$gejalaId] = [
                'value' => $value,
                'label' => $label
            ];
        } else {
            // Jika data tidak valid
            $kepastian[$arkondisi[0]] = [
                'value' => 0,
                'label' => 'Tidak Tahu'
            ];
        }
    }
    // dd($gejalaId, $bobot, $value);
    // dd($request->kondisi); // Debug untuk melihat data yang dikirimkan dari form


    // dd($kepastian); // Periksa hasil bobot dan label yang dihitung

    // Get knowledge base related to symptoms
    $basisPengetahuans = BasisPengetahuan::with('gejala')->get();

    foreach ($basisPengetahuans as $basisPengetahuan) {
        if (isset($kepastian[$basisPengetahuan->gejala_id])) {
            // Jika gejala adalah unfavorable, sesuaikan perhitungan CF
            $cfHasil[] = $basisPengetahuan->cf * $kepastian[$basisPengetahuan->gejala_id]['value'];
        }
    }
    // dd($cfHasil);

    // Gabungkan nilai CF menggunakan metode combineCF yang diperbarui
    $cfCombine = $this->combineCF($cfHasil, array_keys($kepastian)); // Pass gejala IDs for favorable/unfavorable logic

    // Tentukan tingkat kecenderungan berdasarkan CF yang paling tinggi
    $highestCf = $cfCombine;
    $tingkatKecenderungan = $this->determineAddictionLevel($highestCf);

    // Dapatkan data penyakit berdasarkan tingkat kecenderungan
    $penyakit = Penyakit::where('nama', 'like', '%' . $tingkatKecenderungan . '%')->first();

    // Menyimpan hasil diagnosa ke dalam database
    Diagnosa::create([
        'nama' => session('biodata')['nama'],
        'no_hp' => session('biodata')['no_hp'],
        'alamat' => session('biodata')['alamat'],
        'tingkat_kecenderungan' => $tingkatKecenderungan,
        'presentase' => number_format($highestCf * 100, 2), // Periksa jika negatif
    ]);


    // Kirim data ke tampilan
    $biodata = session('biodata');
    $title = $this->title;
    $bcrum = $this->bcrum('Hasil', route('pengguna.diagnosa.index'), $title);
    $gejalas = Gejala::all();

    return view('pengguna.diagnosa.analisa', compact('cfCombine', 'kepastian', 'gejalas', 'title', 'bcrum', 'tingkatKecenderungan', 'penyakit', 'biodata', 'highestCf'));
}

    /**
     * Combine CF values using CF Combine method
     */
private function combineCF(array $cfValues, array $gejalaIds)
{
    // Ambil nilai CF pertama
    $cfCombine = array_shift($cfValues);
    // dd($cfValues);

    // Daftar ID gejala yang memerlukan perhitungan unfavorable
    $unfavorableGejalaIds = [
        'P007', 'P008', 'P009', 'P010', 'P011', 'P012', 'P019', 'P020', 'P021', 'P022', 
        'P023', 'P024', 'P031', 'P032', 'P033', 'P034', 'P035', 'P036'
    ];

    // Iterasi melalui nilai-nilai CF yang tersisa
    foreach ($cfValues as $key => $cf) {
        $gejalaId = $gejalaIds[$key];

        // Debugging: Menampilkan nilai sebelum penggabungan
        // dd(['cfCombine_before' => $cfCombine, 'cf' => $cf, 'gejalaId' => $gejalaId]);

        // Cek apakah gejala tersebut unfavorable dan sesuaikan perhitungan CF
        if (in_array($gejalaId, $unfavorableGejalaIds)) {
            // Logika unfavorable gejala
            $cfCombine = abs($cfCombine - ($cf * (1 - $cfCombine))); // Unfavorable logic
        } else {
            // Logika favorable gejala
            $cfCombine = abs($cfCombine + ($cf * (1 - $cfCombine))); // Favorable logic
        }

        // Debugging: Menampilkan nilai setelah penggabungan
        // dd(['cfCombine_after' => $cfCombine, 'cf' => $cf, 'gejalaId' => $gejalaId]);
    }

    // Debugging: Menampilkan hasil akhir penggabungan CF
    // dd($cfCombine);
    // dd($cfValues, $gejalaIds);

    return $cfCombine;
}

    /**
     * Determine if a gejala ID is considered unfavorable
     */
    private function isUnfavorableGejala($gejalaId)
    {
        // List of unfavorable gejala IDs
        $unfavorableGejalaIds = [7, 8, 9, 10, 11, 12, 19, 20, 21, 22, 23, 24, 31, 32, 33, 34, 35, 36];

        return in_array($gejalaId, $unfavorableGejalaIds);
    }

    /**
     * Determine addiction level based on the highest CF percentage
     */
private function determineAddictionLevel($cfCombine)
{
    $presentase = $cfCombine * 100;
    if ($cfCombine < 0.2) {
        // Tampilkan SweetAlert jika nilai kurang dari 0.2
        echo "<script>
                Swal.fire({
                    icon: 'warning',
                    title: 'Tidak Kecenderungan',
                    text: 'Nilai CF terlalu rendah untuk menentukan kecenderungan.',
                    confirmButtonText: 'OK'
                });
              </script>";
        return 'Tidak Kecenderungan';
    } elseif ($cfCombine >= 0.2 && $cfCombine <= 0.4) {
        return 'Kecenderungan Rendah';
    } elseif ($cfCombine > 0.4 && $cfCombine <= 0.8) {
        return 'Kecenderungan Sedang';
    } elseif ($cfCombine > 0.8 && $cfCombine <= 1) {
        return 'Kecenderungan Tinggi';
    } else {
        // Handle cases where the CF is out of the expected range, if necessary
        return 'Invalid CF value';
    }
}



    public function reset(Request $request)
    {
        $request->session('biodata')->flush();
        return redirect()->route('pengguna.biodata.index');
    }
}
