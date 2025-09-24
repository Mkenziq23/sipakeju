<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\admin\AdminController;
use App\Models\Diagnosa;
use App\Models\Gejala;
use PDF;

class DiagnosaController extends AdminController
{
    public $title = 'Hasil Identifikasi';

    public function index()
    {
        $title = $this->title;

        $user = auth()->user();

        if (in_array($user->role, ['admin', 'asisten1', 'asisten2'])) {
            // Admin dan asisten melihat semua data diagnosa, terbaru dulu
            $diagnosas = Diagnosa::with('user')->latest()->get();
        } elseif ($user->role == 'psikologi') {
            // Psikolog melihat data dengan status tertentu, terbaru dulu
            $diagnosas = Diagnosa::with('user')
                        ->whereIn('status', ['Diserahkan kepada pakar', 'Selesai'])
                        ->latest()
                        ->get();
        } else {
            // User biasa hanya melihat diagnosa miliknya sendiri, terbaru dulu
            $diagnosas = Diagnosa::with('user')
                        ->where('user_id', $user->id)
                        ->latest()
                        ->get();
                        }

        return view('admin.diagnosa.index', compact('diagnosas', 'title'));
    }

    
    

    // public function show(Diagnosa $diagnosa)
    // {
    //     $title = $this->title;
    //     return view('admin.diagnosa.show', compact('diagnosa', 'title'));
    // }

 public function show($id)
{
    $title = 'Show Hasil Identifikasi';
    // Ambil data diagnosa berdasarkan ID
    $diagnosa = Diagnosa::findOrFail($id);

    // Ambil gejala dan kondisi dari diagnosa
    $gejala = Gejala::all();
    $kondisi = json_decode($diagnosa->kondisi, true); // Decode JSON string menjadi array asosiatif

    // Hasil perhitungan Certainty Factor (CF) untuk tingkat kecenderungan
    $highestCf = $diagnosa->presentase;
    $tingkatKecenderungan = $diagnosa->tingkat_kecenderungan;

    // Debug untuk memastikan kondisi sudah menjadi array
    // dd($kondisi);

    return view('admin.diagnosa.show', compact('diagnosa', 'gejala', 'highestCf', 'tingkatKecenderungan', 'title', 'kondisi'));
}


public function print($id)
{
    $title = 'Print Hasil Identifikasi';
    // Fetch the specific diagnosis record by ID
    $diagnosa = Diagnosa::findOrFail($id);
    $gejala = Gejala::all();
    $kondisi = json_decode($diagnosa->kondisi, true); // Decode the conditions from JSON

    // Format the created_at date to match your desired format
    $tanggal = $diagnosa->created_at->format('d-m-Y');

    // Generate the PDF
    $pdf = PDF::loadView('admin.diagnosa.print', compact('diagnosa', 'gejala', 'kondisi', 'title', 'tanggal'));

    // Return the PDF to the browser
    return $pdf->stream('hasil_identifikasi.pdf');  // This will open the PDF directly in the browser
}

    // public function submitToPakar($id)
    // {
    //     $diagnosa = Diagnosa::findOrFail($id);

    //     $user = auth()->user();
    //     if (!in_array($user->role, ['admin', 'asisten1', 'asisten2'])) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     $diagnosa->status = 'Diserahkan kepada pakar'; // Ganti nilai status menjadi 'pending'
    //     $diagnosa->save();

    //     return redirect()->back()->with('success', 'Diagnosa berhasil diserahkan kepada pakar dengan status pending.');
    // }

    public function updateStatus($id)
    {
        $diagnosa = Diagnosa::findOrFail($id);
    
        $user = auth()->user();
        if (!in_array($user->role, ['admin', 'asisten1', 'asisten2', 'psikologi'])) {
            abort(403, 'Unauthorized action.');
        }
    
        $status = request('status');
    
        // Logic khusus untuk batal
        if ($status === '' || $status === null) {
            if ($user->role === 'psikologi') {
                // Jika psikologi klik batal, set status jadi 'Diserahkan kepada pakar'
                $diagnosa->status = 'Diserahkan kepada pakar';
            } else {
                // Untuk role lain, reset status jadi kosong
                $diagnosa->status = null;
            }
            $diagnosa->save();
    
            return redirect()->route('admin.diagnosa.index')
                ->with('success', "Status diagnosa berhasil diubah.");
        }
    
        // Validasi status yang boleh diubah
        $allowedStatuses = ['Diserahkan kepada pakar', 'Selesai'];
        if (!in_array($status, $allowedStatuses)) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }
    
        // Validasi role untuk status tertentu
        if ($status == 'Selesai' && $user->role !== 'psikologi') {
            abort(403, 'Hanya psikologi yang bisa menandai selesai.');
        }
        if ($status == 'Diserahkan kepada pakar' && $user->role !== 'asisten1') {
            abort(403, 'Hanya asisten1 yang bisa menyerahkan ke pakar.');
        }
    
        $diagnosa->status = $status;
        $diagnosa->save();
    
        return redirect()->route('admin.diagnosa.index')
            ->with('success', "Status diagnosa berhasil diubah menjadi '$status'.");
    }
    
    





}
