<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Gejala;
// use App\Models\Penyakit;
use App\Models\BasisPengetahuan;
use App\Http\Controllers\admin\AdminController;

class BasisPengetahuanController extends AdminController
{
    protected $title = 'Basis Pengetahuan';

    public function index()
    {
        $title = $this->title;
        $bps = BasisPengetahuan::with(['gejala',])->get();
        return view('admin.bp.index', compact('title', 'bps'));
    }

    public function create()
    {
        $title = $this->title;
        $gejalas = Gejala::select('id', 'nama')->get();
        // $penyakits = Penyakit::select('id', 'nama')->get();
        return view('admin.bp.create', compact('title', 'gejalas'));
    }

public function store(Request $request)
{
    // Validasi input dengan pesan error kustom
    $request->validate([
        'gejala_id' => 'required|unique:basis_pengetahuan,gejala_id',
        'cf' => 'required|numeric|min:-1|max:1',
    ], [
        'gejala_id.required' => 'Gejala harus dipilih.',
        'gejala_id.unique' => 'Gejala ini sudah ada dalam basis pengetahuan.',
        'cf.required' => 'Faktor Kepastian harus diisi.',
        'cf.numeric' => 'Faktor Kepastian harus berupa angka.',
        'cf.min' => 'Faktor Kepastian tidak boleh kurang dari -1.',
        'cf.max' => 'Faktor Kepastian tidak boleh lebih dari 1.',
    ]);

    // Simpan data jika validasi lolos
    BasisPengetahuan::create($request->all());

    // Notifikasi berhasil
    $this->notification('success', 'Berhasil', 'Data Basis Pengetahuan Berhasil Ditambah');

    return redirect(route('admin.bp.index'));
}



    // public function show(BasisPengetahuan $bp)
    // {
    //     $title = $this->title;
    //     return view('admin.bp.show', compact('title', 'bp'));
    // }

    public function edit(BasisPengetahuan $bp)
    {
        $title = $this->title;
        $gejalas = Gejala::select('id', 'nama')->get();
        // $penyakits = Penyakit::select('id', 'nama')->get();
        return view('admin.bp.edit', compact('bp', 'gejalas', 'title'));
    }

public function update(Request $request, BasisPengetahuan $bp)
{
    // Validasi input
    $request->validate([
        'gejala_id' => 'required|unique:basis_pengetahuan,gejala_id,' . $bp->id, // Menjaga validasi unik kecuali pada data yang sedang diupdate
        'cf' => 'required|numeric|min:-1|max:1',
    ], [
        'gejala_id.required' => 'Gejala harus dipilih.',
        'gejala_id.unique' => 'Gejala ini sudah ada dalam basis pengetahuan.',
        'cf.required' => 'Faktor Kepastian harus diisi.',
        'cf.numeric' => 'Faktor Kepastian harus berupa angka.',
        'cf.min' => 'Faktor Kepastian tidak boleh kurang dari -1.',
        'cf.max' => 'Faktor Kepastian tidak boleh lebih dari 1.',
    ]);

    // Update data jika validasi lolos
    $bp->update($request->all());

    // Notifikasi berhasil
    $this->notification('success', 'Berhasil', 'Data Basis Pengetahuan Berhasil Diupdate');

    return redirect(route('admin.bp.index'));
}


    public function destroy(BasisPengetahuan $bp)
    {
        $hapus = $bp->delete();

        return response()->json([$hapus], 200);
    }
}
