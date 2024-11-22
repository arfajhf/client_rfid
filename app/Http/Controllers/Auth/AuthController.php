<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DataPenyewa;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    public function formLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'username' => 'required|exists:admins,username', // Pastikan 'username' ada di tabel admins
            'password' => 'required',
        ]);

        // Coba autentikasi dengan guard 'admin'
        if (Auth::guard('admin')->attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password']
        ], $request->remember)) {

            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Ambil data penyewa berdasarkan ID
            $idPenyewa = DataPenyewa::find(Auth::guard('admin')->user()->id_penyewa);

            // Cek apakah ID penyewa cocok dan status aktif
            if ($idPenyewa && $idPenyewa->id == Auth::guard('admin')->user()->id_penyewa) {
                if ($idPenyewa->status == "aktif") {
                    // Redirect ke halaman admin jika status penyewa 'aktif'
                    return redirect()->intended(config('admin.prefix'));
                } else {
                    // Jika status tidak aktif, logout dan beri pesan error
                    Auth::guard('admin')->logout();
                    return back()->withErrors([
                        'username' => 'Akun anda sudah tidak aktif, silahkan hubungi kontak support',
                    ]);
                }
            }

            // Jika ID penyewa tidak ditemukan atau tidak cocok
            Auth::guard('admin')->logout();
            return back()->withErrors([
                'username' => 'Invalid user information.',
            ]);
        }

        // Jika login gagal
        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username', 'remember'));
    }



    // public function login(Request $request)
    // {

    //     $credentials = $request->validate([
    //         'username'=>'required|exists:admins',
    //         'password'=>'required'
    //     ]);

    //     if (Auth::guard('admin')->attempt($credentials, $request->remember)) {
    //         $request->session()->regenerate();
    //         $id = DataPenyewa::find($request->user()->id_penyewa);
    //         if($id == $request->user()->id_penyewa){
    //             return redirect()->intended(config('admin.prefix'));
    //         }
    //     }

    //     return back()->withErrors([
    //         'username' => 'The provided credentials do not match our records.',
    //     ]);
    // }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
