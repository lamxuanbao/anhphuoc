<?php

namespace Kizi\Core\Services;

use Illuminate\Support\Facades\Auth;
use Kizi\Core\Models\Users;

class UserService implements \Kizi\Core\Contracts\Services\UserService
{
    public function login($request)
    {
        $email    = $request->input('email');
        $password = $request->input('password');
        $user     = Users::email($email)
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

        return $this->respondWithToken(Auth::login($user));
        $role = $request->header('App-Role') ?? null;
        switch ($role) {
            case 'admin':
                return $this->admin($request);
                break;
            default:
                return $this->guest($request);
                break;
        }
    }

    private function respondWithToken($token)
    {
        return response_api(
            [
                'token'      => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::factory()
                                    ->getTTL() * 60,
            ]
        );
    }
}