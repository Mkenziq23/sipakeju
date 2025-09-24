<?php

namespace App\Http\Controllers\pengguna;

use App\Http\Controllers\pengguna\PenggunaController;
use App\Models\Diagnosa;
use Illuminate\Http\Request;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\BasisPengetahuan;
use App\Models\Range;

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
            3 => 0.8,  // Sangat Setuju
            4 => 0.0
        ]; // Bobot favorable

        $arbobotUnfavorable = [
            0 => 0.8, // Sangat Tidak Setuju
            1 => 0.6, // Tidak Setuju
            2 => 0.4, // Setuju
            3 => 0.2,  // Sangat Setuju
            4 => 0.0
        ]; // Bobot unfavorable

        $confidenceLabels = [
            'Sangat Tidak Setuju',
            'Tidak Setuju',
            'Setuju',
            'Sangat Setuju',
            'Tidak Tahu'
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

            if (isset($arkondisi[0]) && isset($arkondisi[1])) {
                $gejalaId = $arkondisi[0];
                $bobot = (int)$arkondisi[1]; // Ubah ke integer untuk memetakan nilai yang benar

                if (in_array($gejalaId, $unfavorableIds)) {
                    // Unfavorable
                    $value = $arbobotUnfavorable[$bobot];
                } else {
                    // Favorable
                    $value = $arbobotFavorable[$bobot];
                }

                $label = $confidenceLabels[$bobot]; // Menentukan label sesuai bobot yang dipilih

                $kepastian[$gejalaId] = [
                    'value' => $value,
                    'label' => $label
                ];
            } else {
                $kepastian[$arkondisi[0]] = [
                    'value' => 0,
                    'label' => 'Tidak Tahu'
                ];
            }
        }

        // Get knowledge base related to symptoms
        $basisPengetahuans = BasisPengetahuan::with('gejala')->get();

        foreach ($basisPengetahuans as $basisPengetahuan) {
            if (isset($kepastian[$basisPengetahuan->gejala_id])) {
                $cfHasil[] = $basisPengetahuan->cf * $kepastian[$basisPengetahuan->gejala_id]['value'];
            }
        }

        // dd($kepastian); // Untuk mengecek struktur data yang dikirim


        // Combine CF using combineCF
        $cfCombine = $this->combineCF($cfHasil, array_keys($kepastian)); 

        $highestCf = $cfCombine;
        $tingkatKecenderungan = $this->determineAddictionLevel($highestCf);

        $penyakit = Penyakit::where('nama', 'like', '%' . $tingkatKecenderungan . '%')->first();

        // dd($penyakit);


        // Menyimpan hasil diagnosa ke dalam database
        if (auth()->check()) {
            $diagnosaId = $request->session()->get('diagnosa_id');
            if (auth()->user()->role === 'psikologi') {
                $namaPakar = auth()->user()->name;
            }  elseif (auth()->user()->role === 'client' || auth()->user()->role === 'admin') {
                $namaPakar = 'Panca Kursistin Handayani, S.Psi., MA';
            }

            if ($diagnosaId) {
                // Update diagnosa lama supaya tidak duplikat
                $diagnosa = Diagnosa::find($diagnosaId);
                if ($diagnosa) {
                    $diagnosa->update([
                        'user_id' => auth()->id(),
                        'nama' => session('biodata')['nama'],
                        'no_hp' => session('biodata')['no_hp'],
                        'alamat' => session('biodata')['alamat'],
                        'pakar' => $namaPakar,
                        'deskripsi' => $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.',
                        'solusi' => $penyakit ? $penyakit->solusi : 'Tidak ada solusi terkait.',
                        'kondisi' => json_encode($kepastian),
                        'tingkat_kecenderungan' => $tingkatKecenderungan,
                        'presentase' => number_format($highestCf * 100, 2),
                    ]);
                } else {
                    // Jika data sebelumnya tidak ditemukan, buat baru
                    $diagnosa = Diagnosa::create([
                        'user_id' => auth()->id(),
                        'nama' => session('biodata')['nama'],
                        'no_hp' => session('biodata')['no_hp'],
                        'alamat' => session('biodata')['alamat'],
                        'pakar' => $namaPakar,
                        'deskripsi' => $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.',
                        'solusi' => $penyakit ? $penyakit->solusi : 'Tidak ada solusi terkait.',
                        'kondisi' => json_encode($kepastian),
                        'tingkat_kecenderungan' => $tingkatKecenderungan,
                        'presentase' => number_format($highestCf * 100, 2),
                    ]);
                    $request->session()->put('diagnosa_id', $diagnosa->id);
                }
            } else {
                // Jika belum ada di session, buat data baru dan simpan id ke session
                $diagnosa = Diagnosa::create([
                    'user_id' => auth()->id(),
                    'nama' => session('biodata')['nama'],
                    'no_hp' => session('biodata')['no_hp'],
                    'alamat' => session('biodata')['alamat'],
                    'pakar' => $namaPakar,
                    'deskripsi' => $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.',
                    'solusi' => $penyakit ? $penyakit->solusi : 'Tidak ada solusi terkait.',
                    'kondisi' => json_encode($kepastian),
                    'tingkat_kecenderungan' => $tingkatKecenderungan,
                    'presentase' => number_format($highestCf * 100, 2),
                ]);
                $request->session()->put('diagnosa_id', $diagnosa->id);
            }
        }
        // if (auth()->check()) {
        //     $diagnosa = Diagnosa::create([
        //         'nama' => session('biodata')['nama'],
        //         'no_hp' => session('biodata')['no_hp'],
        //         'alamat' => session('biodata')['alamat'],
        //         'pakar' => auth()->user()->name ?? null,
        //         'deskripsi' => $penyakit ? $penyakit->deskripsi : 'Tidak ada deskripsi terkait.',
        //         'kondisi' => json_encode($kepastian),  // Menyimpan kondisi sebagai JSON
        //         'tingkat_kecenderungan' => $tingkatKecenderungan,
        //         'presentase' => number_format($highestCf * 100, 2),
        //     ]);
        // }

        // Dapatkan data penyakit berdasarkan tingkat kecenderungan
        // $penyakit = Penyakit::where('nama', 'like', '%' . $tingkatKecenderungan . '%')->first();
        

        // Kirim data ke tampilan
        $biodata = session('biodata');
        $title = $this->title;
        $bcrum = $this->bcrum('Hasil', route('pengguna.diagnosa.index'), $title);
        $gejalas = Gejala::all();


        if (auth()->check()) {
            // return view('pengguna.diagnosa.analisa', compact(
            //     'cfCombine', 'kepastian', 'gejalas', 'title', 'bcrum', 
            //     'tingkatKecenderungan', 'penyakit', 'biodata', 'highestCf', 'diagnosa'
            // ));
            return view('pengguna.terimakasih');

        } else {
            // return view('pengguna.diagnosa.analisa', compact(
            //     'cfCombine', 'kepastian', 'gejalas', 'title', 'bcrum', 
            //     'tingkatKecenderungan', 'penyakit', 'biodata', 'highestCf'
            // ));
            return view('pengguna.terimakasih');

        }
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
// private function determineAddictionLevel($cfCombine)
// {
//     $presentase = $cfCombine * 100;
//     if ($cfCombine < 0.2) {
//         // Tampilkan SweetAlert jika nilai kurang dari 0.2
//         echo "<script>
//                 Swal.fire({
//                     icon: 'warning',
//                     title: 'Tidak Kecenderungan',
//                     text: 'Nilai CF terlalu rendah untuk menentukan kecenderungan.',
//                     confirmButtonText: 'OK'
//                 });
//               </script>";
//         return 'Tidak Kecenderungan';
//     } elseif ($cfCombine >= 0.2 && $cfCombine <= 0.4) {
//         return 'Kecenderungan Rendah';
//     } elseif ($cfCombine > 0.4 && $cfCombine <= 0.8) {
//         return 'Kecenderungan Sedang';
//     } elseif ($cfCombine > 0.8 && $cfCombine <= 1) {
//         return 'Kecenderungan Tinggi';
//     } else {
//         // Handle cases where the CF is out of the expected range, if necessary
//         return 'Invalid CF value';
//     }
//     }

private function determineAddictionLevel($cfCombine)
{
    // Ambil data Range berdasarkan rentang CF yang sesuai
    $range = Range::where('min_value', '<=', $cfCombine)
                  ->where('max_value', '>=', $cfCombine)
                  ->first();

    if ($range) {
        // Jika ditemukan rentang yang sesuai
        return $range->keterangan; // Keterangan kecenderungan berdasarkan Range
    } else {
        // Jika tidak ada kecocokan, kembalikan 'Tidak Kecenderungan'
        return 'Tidak Kecenderungan';
    }
}


    public function reset(Request $request)
        {
            // Ambil id diagnosa dari session
        $diagnosaId = $request->session()->get('diagnosa_id');

        if ($diagnosaId) {
            // Hapus data diagnosa dari database
            Diagnosa::where('id', $diagnosaId)->delete();

            // Hapus session diagnosa_id dan biodata
            $request->session()->forget('diagnosa_id');
        }

            $request->session()->forget('biodata');
            return redirect()->route('pengguna.biodata.index')
            ->with('success', 'Data diagnosa dan biodata berhasil direset.');
        }

    public function updateSolusi(Request $request)
    {
        $diagnosaId = $request->input('diagnosa_id');
        $solusi = $request->input('solusi');

        $diagnosa = Diagnosa::find($diagnosaId);

        if (!$diagnosa) {
            return redirect()->back()->with('error', 'Data diagnosa tidak ditemukan.');
        }

        if ($diagnosa->solusi != $solusi) {
            $diagnosa->solusi = $solusi;
            $diagnosa->save();

            return redirect()->route('pengguna.diagnosa.show', $diagnosa->id)
                            ->with('success', 'Solusi berhasil diperbarui!');
        } else {
            return redirect()->route('pengguna.diagnosa.show', $diagnosa->id)
                            ->with('info', 'Solusi tidak berubah!');
        }
    }

        
    public function show($id)
    {
        // Ambil data diagnosa berdasarkan ID
        $diagnosa = Diagnosa::find($id);
        $kondisi = json_decode($diagnosa->kondisi, true); // Pastikan kondisi didecode menjadi array
        $penyakit = Penyakit::find($diagnosa->penyakit_id); 
        $title = 'Hasil Diagnosa';
        $bcrum = $this->bcrum('Diagnosa');
        // Ambil semua data gejala
        $gejalas = Gejala::all();

        return view('pengguna.diagnosa.show', compact('diagnosa', 'kondisi', 'gejalas', 'penyakit', 'title', 'bcrum'));
    }




}
