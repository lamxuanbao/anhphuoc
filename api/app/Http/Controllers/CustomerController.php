<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Kizi\Core\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

//    public function register()
//    {
//        $this->validate(
//            $this->request,
//            [
//                'email'    => 'required|string',
//                'password' => 'required|string',
//            ]
//        );
//
//        $credentials = $this->request->only(['email', 'password']);
//        $a           = 1;
//        $aas         = 2;
//    }

    public function login()
    {
        dd($this->request);
    }


}
