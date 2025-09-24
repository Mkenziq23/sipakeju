<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * Redirect after registration
     */
    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Tampilkan halaman form registrasi
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Validator untuk input register
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role'     => ['required', 'in:pasien'],
        ]);
    }

    /**
     * Membuat user baru
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'username' => $data['username'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);
    }

    /**
     * Proses pendaftaran user
     */
    public function register(Request $request)
    {
        // Validasi input
        $this->validator($request->all())->validate();

        // Simpan data user
        $this->create($request->all());

        // Redirect ke halaman login dengan pesan sukses
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
