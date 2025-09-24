<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Range;
use Illuminate\Http\Request;

class RangeController extends Controller
{
    public $title = 'Range';

    public function index()
    {
        $title = $this->title;
        $ranges = Range::all(); // pastikan model 'Range' sudah di-import

        return view('admin.range.index', compact('title', 'ranges'));;
    }

    public function create()
    {
        $title = $this->title;
        return view('admin.range.create', compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'min_value' => 'required|numeric|min:0|max:1',
            'max_value' => 'required|numeric|min:0|max:1|gt:min_value',
            'keterangan' => 'required|string|max:255',
        ]);

        Range::create([
            'min_value' => $request->min_value,
            'max_value' => $request->max_value,
            'keterangan' => $request->keterangan,
        ]);
        
    // $this->notification('success', 'Berhasil', 'Data Basis Pengetahuan Berhasil Ditambah');


        return redirect()->route('admin.range.index')->with('success', 'Range berhasil ditambahkan');
    }


    public function show(Range $range)
    {
        //
    }

// Method untuk menampilkan form edit
    public function edit(Range $range)
    {
        $title = 'Edit Range CF';  // Menentukan judul halaman
        return view('admin.range.edit', compact('title', 'range'));  // Mengoper data range ke view
    }

    // Method untuk menyimpan perubahan
    public function update(Request $request, Range $range)
    {
        // Validasi data input
        $validatedData = $request->validate([
            'min_value' => 'required|numeric',
            'max_value' => 'required|numeric|gte:min_value',
            'keterangan' => 'required|string|max:255',
        ]);

        // Update data range
        $range->update($validatedData);

        // Redirect setelah sukses
        return redirect()->route('admin.range.index')->with('success', 'Data Range CF berhasil diperbarui');
    }


    public function destroy(Range $range)
    {
        // Menghapus data berdasarkan id
        $range->delete();

        // Menambahkan notifikasi ke session
        session()->flash('success', 'Data Range CF berhasil dihapus');

        // Redirect ke halaman index
        return redirect()->route('admin.range.index');
    }

}
