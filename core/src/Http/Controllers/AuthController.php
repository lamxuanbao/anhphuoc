<?php


namespace Kizi\Core\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kizi\Core\Models\Users;

class AuthController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function login()
    {
        $this->validate(
            $this->request,
            [
                'email'    => 'required|email',
                'password' => 'required|string',
            ]
        );

        $email    = $this->request->input('email');
        $password = $this->request->input('password');
        $user     = Users::email($email)
                         ->first();

        if (!$user) {
            return response_api(
                [
                    'email' => [
                        'Email does not exists'
                    ],
                ],
                422,
                'Email does not exists'
            );
        }

        dd($password, $user->password,Hash::check($password, $user->password));
        // if (!Hash::check($password, $user->password)) {
        //     return response_api(
        //         [
        //             'password' => [
        //                 'Password is incorrect'
        //             ],
        //         ],
        //         422,
        //         'Password is not incorrect'
        //     );
        // }

        return $this->respondWithToken(Auth::login($user));
    }

    protected function respondWithToken($token)
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

    public function profile()
    {
        return response_api(Auth::user());
    }
}
