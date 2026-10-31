<?php
namespace App\Http\Controllers\Api;

use Illuminate\Validation\Rule;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:30'],
            'nik' => ['required', 'digits:16', Rule::unique(User::class, 'nik')],
            'email' => ['required', 'email', 'max:30', Rule::unique(User::class, 'email')],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'role' => 'Orang Tua',
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil. Silakan login.',
            'user' => $user,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)
            ->first();

        if (!$user || !Hash::check(
            $request->password,
            $user->password
        )) {
            return response()->json([
                'message' => 'Email atau password salah.',
            ], 401);
        }

        if ($user->role !== 'Orang Tua') {
            return response()->json([
                'message' => 'Akun tidak memiliki akses mobile.',
            ], 403);
        }

        $token = $user->createToken(
            'stuntguard-mobile'
        )->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil.',
            'user' => $user,
            'token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'user' => $request->user(),
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()
            ->currentAccessToken()
            ->delete();

        return response()->json([
            'message' => 'Logout berhasil.',
        ]);
    }
}
