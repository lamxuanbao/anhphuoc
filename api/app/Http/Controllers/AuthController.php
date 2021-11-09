<?php
namespace App\Http\Controllers;


use Kizi\Core\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function register()
    {
        $this->validate($this->request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $this->request->only(['email', 'password']);
        $a   = 1;
        $aas = 2;
    }

}
