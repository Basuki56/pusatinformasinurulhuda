<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Traits\ApiResponse;
use App\Services\JwtService;
use App\Models\User;

class AuthController extends Controller
{
    use ApiResponse;

    protected $jwt;

    public function __construct(JwtService $jwt)
    {
        $this->jwt = $jwt;
    }

    public function showLoginForm()
    {
        return view('sign-in');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        Log::info('Mencoba login dengan:', $credentials);

        if (!$token = auth('api')->attempt($credentials)) {
            Log::warning('Login gagal untuk email:', ['email' => $request->email]);
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized'
            ], 401, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        $user = auth('api')->user();
        $userArr = [
            'id_user' => $user->id_user,
            'nama' => $user->nama,
            'email' => $user->email,
            'role' => $user->role,
            'unit_id' => $user->unit_id,
        ];

        Log::info('Login berhasil:', ['user_id' => $user->id_user]);
        return response()->json([
            'status' => true,
            'user' => $userArr,
            'token' => $token
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200, [], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}
