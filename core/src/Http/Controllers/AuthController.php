<?php


namespace Kizi\Core\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kizi\Core\Contracts\Services\UserService;
use Kizi\Core\CoreManager;
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
        return app(UserService::class)->login($this->request);
    }

    public function profile()
    {
        $guard = $this->request->header('App-Role') ?? null;
        return response_api(auth($guard)->user());
    }
}
