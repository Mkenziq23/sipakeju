<?php

namespace App\Http\Controllers\pengguna;

use App\Http\Controllers\pengguna\PenggunaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiodataController extends PenggunaController
{
    protected $title = "Biodata";

    public function index()
    {
        $user = Auth::user();
        $title = $this->title;
        $bcrum = $this->bcrum('Biodata');
        return view('pengguna.biodata.index', compact('title', 'bcrum', 'user'));
    }

    public function store(Request $request)
    {
        Session([
            'biodata' => [
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
            ]
        ]);
        return redirect()->route('pengguna.diagnosa.index');
    }
}
