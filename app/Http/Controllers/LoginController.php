<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session; 

class LoginController extends Controller
{
    public function index()
    {
        // Mengecek apakah pengguna sudah login
        if (Auth::check()) {
            // Jika sudah login, arahkan langsung ke dashboard
            return redirect()->intended('/dashboard');
        }

        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nama_user' => 'required', // Validasi nama_user
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('nama_user', $request->nama_user)->first();


        // Menggunakan nama_user untuk login
        // Cek apakah user ditemukan
        if ($user) {
            // Bandingkan password yang diinput (setelah di-MD5) dengan password di database
            $inputPasswordMd5 = md5($request->password);
            
            if ($inputPasswordMd5 === $user->password) {
                Auth::login($user);
                
                // Simpan nama admin di session
                Session::put('admin_id', $user->id_user);
Session::put('admin_name', $user->nama_user);
                
                return redirect()->intended('/dashboard');
            }
        }
        return back()->withErrors([
            'nama_user' => 'Nama pengguna atau password salah.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
