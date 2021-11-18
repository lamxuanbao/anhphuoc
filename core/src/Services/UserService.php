<?php

namespace Kizi\Core\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kizi\Core\Models\Users;
use function PHPUnit\Framework\isNull;

class UserService implements \Kizi\Core\Contracts\Services\UserService
{
    public function login($request)
    {
        $guards = config('auth');
        $check = $guards['defaults']['guard'] ?? null;
        $email = $request->input('email');
        $password = $request->input('password');
        $guard = $request->header('App-Role') ?? null;
        if (!isset($guards['guards'][$guard])) {
            $guard = null;
        }
        if (is_null($guard) || $guard === $check) {
            $user = Users::email($email)
                ->first();

            if (!$user) {
                return response_api(
                    [
                        'email' => [
                            'Email does not exists',
                        ],
                    ],
                    422,
                    'Email does not exists'
                );
            }
            if (!Hash::check($password, $user->password)) {
                return response_api(
                    [
                        'password' => [
                            'Password is incorrect',
                        ],
                    ],
                    422,
                    'Password is not incorrect'
                );
            }
        }

        $input = ['email' => $email, 'password' => $password];
        $token = auth($guard)->attempt($input);
        if (is_null($token)) {
            return response_api(
                [
                    'email' => [
                        'Email does not exists',
                    ],
                ],
                422,
                'Email does not exists'
            );
        }
        return response_api(
            [
                'token' => $token,
                'token_type' => 'bearer',
                'guard' => $guard,
                'expires_in' => Auth::factory()
                        ->getTTL() * 60,
            ]
        );
    }
}