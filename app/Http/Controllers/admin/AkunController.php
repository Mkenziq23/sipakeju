<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\admin\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class AkunController extends AdminController
{
    public $title = 'Akun';

    public function index()
    {
        $title = $this->title;
        $user = auth()->user();
    
        // Ambil semua akun, kecuali tergantung role user
        $akuns = User::query();
    
        if ($user->role === 'psikologi') {
            $akuns->whereNotIn('role', ['admin']);
        } elseif (in_array($user->role, ['asisten1', 'asisten2'])) {
            $akuns->whereNotIn('role', ['admin', 'psikologi']);
        }
    
        $akuns = $akuns->latest()->get();
    
        return view('admin.akun.index', compact('title', 'akuns'));
    }
    function generateClientCode()
    {
        return 'CLT-' . strtoupper(\Str::random(6)); // contoh: CLT-AB12CD
    }
    
    public function create()
    {
        $title = $this->title;
        return view('admin.akun.create', compact('title'));
    }

    public function store(Request $request)
    {
        $userRole = Auth::user()->role;

        // Tentukan role yang diizinkan
        $allowedRoles = match ($userRole) {
            'admin' => ['admin', 'psikologi', 'asisten1', 'asisten2', 'client'],
            'psikologi' => ['asisten1', 'asisten2'],
            'asisten1', 'asisten2' => ['client'],
            default => []
        };

        // Validasi request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => ['required', Rule::in($allowedRoles)],
        ]);

        // Cek role, jika client simpan password asli, jika bukan client maka bcrypt
        $password = $validated['password'];
        if ($validated['role'] !== 'client') {
            $password = bcrypt($validated['password']);
        }

        // Buat kode client jika role client, kalau bukan null
        $clientCode = null;
        if ($validated['role'] === 'client') {
            // Generate kode unik client, cek agar tidak ada duplikat
            do {
                $code = 'CLT-' . strtoupper(\Str::random(6));
            } while (User::where('client_code', $code)->exists());
            $clientCode = $code;
        }

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => $password,
            'role' => $validated['role'],
            'client_code' => $clientCode,
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun berhasil ditambahkan.');
    }


    public function edit(User $akun)
    {
        $title = $this->title;
        $currentUser = auth()->user();
    
        // Batasi akses edit sesuai role
        if ($currentUser->role === 'psikologi' && !in_array($akun->role, ['asisten1', 'asisten2'])) {
            abort(403, 'Anda tidak diizinkan mengedit akun ini.');
        }
    
        if (in_array($currentUser->role, ['asisten1', 'asisten2']) && $akun->role !== 'client') {
            abort(403, 'Anda tidak diizinkan mengedit akun ini.');
        }
    
        return view('admin.akun.edit', compact('akun', 'title'));
    }
    

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $currentUser = auth()->user();

    // Cek akses edit role sesuai aturan
    if ($currentUser->role === 'psikologi' && !in_array($user->role, ['asisten1', 'asisten2'])) {
        abort(403, 'Anda tidak diizinkan mengedit akun ini.');
    }

    if (in_array($currentUser->role, ['asisten1', 'asisten2']) && $user->role !== 'client') {
        abort(403, 'Anda tidak diizinkan mengedit akun ini.');
    }

    // Validasi dasar
    $rules = [
        'name' => 'required|string|max:255',
        'username' => 'required|string|max:255|unique:users,username,' . $user->id,
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:admin,psikologi,asisten1,asisten2,client',
    ];

    // Jika user ingin ganti password, validasi password
    if ($request->filled('password')) {
        $rules['password'] = 'confirmed|min:6';
    }

    $validated = $request->validate($rules);

    // Jika bukan admin, jangan ubah role (override dari input)
    if ($currentUser->role !== 'admin') {
        $validated['role'] = $user->role;
    }

    // Update data user
    $user->name = $validated['name'];
    $user->username = $validated['username'];
    $user->email = $validated['email'];
    $user->role = $validated['role'];

    // Jika password diisi, hash dan update
    if (!empty($validated['password'])) {
        $user->password = bcrypt($validated['password']);
    }

    $user->save();

    $this->notification('success', 'Berhasil', 'Data Akun Berhasil Diubah');
    return redirect(route('admin.akun.index'));
}

    

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        $this->notification('success', 'Berhasil', 'Data Akun Berhasil Dihapus');
        return redirect(route('admin.akun.index'));
    }


    public function show($id)
    {
        $title = $this->title;
        $akun = User::findOrFail($id);
        $user = auth()->user();
    
        // Validasi akses
        if ($user->role === 'psikologi' && $akun->role === 'admin') {
            abort(403, 'Anda tidak diizinkan melihat akun ini.');
        }
    
        if (in_array($user->role, ['asisten1', 'asisten2']) && in_array($akun->role, ['admin', 'psikologi'])) {
            abort(403, 'Anda tidak diizinkan melihat akun ini.');
        }
    
        return view('admin.akun.show', compact('akun', 'title'));
    }
    

}
