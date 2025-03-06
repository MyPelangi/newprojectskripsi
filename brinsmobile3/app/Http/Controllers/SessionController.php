<?php

namespace App\Http\Controllers;

use session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    public function index(){
        return view('auth/login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation

            // Tambahkan pesan sukses ke session
            session()->flash('success', 'Login berhasil! Selamat datang, ' . Auth::user()->nama);

            return redirect()->intended('/home'); // Redirect ke halaman setelah login
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }


    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth/register');
    }

    public function createAccount(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|date',
            'no_ktp' => 'required|string|size:16|unique:users,no_ktp',
            'kewarganegaraan' => 'required|string|max:255',
            'status_menikah' => 'required|in:Belum Menikah,Menikah,Cerai',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:255',
            'sumber_pendapatan' => 'required|in:Gaji,Usaha,Investasi,Lainnya',
            'pendapatan_tahunan' => 'required|numeric|min:0',
            'tujuan' => 'required|string|max:255',
            'nama_penerima' => 'required|string|max:255',
            'kantor_cabang' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6',
            'no_telp' => 'required|string|max:15',
            'kode_pos' => 'required|string|size:5',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan_kelurahan' => 'required|string|max:255',
            'alamat_lengkap' => 'required|string',
            'alamat_kantor' => 'required|string',
            'no_telp_kantor' => 'required|string|max:15',
        ]);

        // dd($validated);
        // Simpan data ke database
        $user = User::create([
            'nama' => $request->nama,
            'gender' => $request->gender,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_ktp' => $request->no_ktp,
            'kewarganegaraan' => $request->kewarganegaraan,
            'status_menikah' => $request->status_menikah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan' => $request->pekerjaan,
            'sumber_pendapatan' => $request->sumber_pendapatan,
            'pendapatan_tahunan' => $request->pendapatan_tahunan,
            'tujuan' => $request->tujuan,
            'nama_penerima' => $request->nama_penerima,
            'kantor_cabang' => $request->kantor_cabang,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash password
            'no_telp' => $request->no_telp,
            'kode_pos' => $request->kode_pos,
            'provinsi' => $request->provinsi,
            'kota' => $request->kota,
            'kecamatan_kelurahan' => $request->kecamatan_kelurahan,
            'alamat_lengkap' => $request->alamat_lengkap,
            'alamat_kantor' => $request->alamat_kantor,
            'no_telp_kantor' => $request->no_telp_kantor,
        ]);

        return redirect('/');

    }

    public function profil(){
        return view ('pages/profil');
    }
}
