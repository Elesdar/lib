<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Events\UserCreatedEvent;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(
        RegisterRequest $request,
    ): JsonResponse {
        try {
            DB::transaction(function () use ($request) {
                $validated = $request->validated();
                $validated['password'] = Hash::make($validated['password']);
                $user = User::create($validated);

                UserCreatedEvent::dispatch($user);
            });
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'message' => ['Не получилось зарегистрироваться'],
            ]);
        }

        return response()->json([
            'message' => 'Регистрация прошла успешно',
        ]);
    }

    /**
     * Get a JWT via given credentials.
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);

        $ttl = 60 * 24 * 30;  // 30 days
        JWTAuth::factory()->setTTL($ttl);

        if (! $token = JWTAuth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'message' => ['Неверный логин или пароль.'],
            ]);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     */
    public function user(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     */
    public function logout(): JsonResponse
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'message' => 'Не получилось разлогиниться',
            ]);
        }

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     */
    public function refresh(): JsonResponse   // TODO ?
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string  $token
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60,
        ]);
    }

    public function isAuthorized(Request $request): JsonResponse
    {
        if (auth()->user()) {
            return response()->json([
                'isAuthorized' => true,
            ]);
        }

        return response()->json([
            'isAuthorized' => false,
        ]);
    }
}
