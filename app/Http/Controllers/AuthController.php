<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use App\Models\Admin;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        // dd(session()->all());
        
        if (session()->has('token') && session()->has('admin_id')) {
            $admin = \App\Models\Admin::find(session('admin_id'));
            if ($admin && $admin->token === session('token')) {
                return redirect()->route('dashboard');
            }
        }
        
        return response()
        ->view('auth.login')
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
        
    }

    public function login(Request $request)
    {
        // dd(session()->all());
        
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
 
        $admin = Admin::where('username', $request->username)->first();

        if ($admin) {
            if ($admin->flag_active == 1) {
                return back()->withErrors(['username' => 'Anda tidak di izinkan mengakses situs ini!.']);
            }

            if (Hash::check($request->password, $admin->password)) {
                $token = Str::random(60);
                $admin->update([
                    'token' => $token,
                    'last_login_at' => now(),
                ]);

                $mime = null;
                $fotoBase64 = null;

                if ($admin->foto) {
                    $finfo = new \finfo(FILEINFO_MIME_TYPE);
                    $mime = $finfo->buffer($admin->foto);

                    $fotoBase64 = 'data:' . $mime . ';base64,' . base64_encode($admin->foto);
                }

                session([
                    'admin_id' => $admin->id,
                    'token' => $token,
                    'nama' => $admin->nama,
                    'level' => $admin->level,
                    'foto' => $fotoBase64 ?? asset('/img/default-user.png'),
                    'last_activity' => now(),
                ]);

                return redirect()->route('dashboard');
            }
        }
        return back()->withErrors(['username' => 'Akses ditolak!']);
    }

    public function logout()
    {
        $admin = Admin::find(session('admin_id'));
        if ($admin) {
            $admin->update(['token' => null]);
        }

        session()->flush();
        return redirect('/login');
    }
}