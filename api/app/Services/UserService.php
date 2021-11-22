<?php
/**
 * Created by PhpStorm.
 * User: nhockizi
 * Date: 11/17/21
 * Time: 13:38
 */

namespace App\Services;


use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kizi\Core\Models\Users;

class UserService extends \Kizi\Core\Services\UserService
{
    public function login($request)
    {
        $guards = config('auth');
        $email = $request->input('email');
        $password = $request->input('password');
        $guard = $request->header('App-Role') ?? null;
        if (!isset($guards['guards'][$guard])) {
            $guard = null;
        }
        if (is_null($guard) || $guard === 'admin') {
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
        if (is_null($guard) || $guard === 'customers') {
            $user = Customers::email($email)
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
        if (!$token) {
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
                'expires_in' => Auth::factory()
                        ->getTTL() * 60,
            ]
        );
    }
}