<?php

namespace App\Http\Controllers;


use Illuminate\Http\Response;
use Kizi\Core\Contracts\Repositories\UserRepository;
use Kizi\Core\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function validateStore()
    {
        request()->merge(
            [
                'is_active' => true,
            ]
        );
        $this->validation(
            [
                'email'    => [
                    'required',
                    'email',
                    'max:191',
                    'unique:users',
                ],
                'password' => [
                    'required',
                    'min:6',
                    'max:20',
                ],
            ]
        );
        parent::validateStore(); // TODO: Change the autogenerated stub
    }
}
