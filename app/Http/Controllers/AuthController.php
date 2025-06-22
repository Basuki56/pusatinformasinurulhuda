<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
   public function showLoginForm()
    {
        return view('sign-in');
    }
    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');
    Log::info('Mencoba login dengan:', $credentials); // Tambahan ini
    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        Log::info('Login berhasil:', ['user_id' => Auth::id()]);
        return redirect()->intended('/dashboard');
    }
    Log::warning('Login gagal untuk email:', ['email' => $request->email]);
    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
}
}