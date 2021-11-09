<?php


namespace Kizi\Core\Http\Controllers;

use Kizi\Core\Contracts\Repositories\WardRepository;

class WardController extends Controller
{
    public function __construct(WardRepository $repository)
    {
        $this->repository = $repository;
    }
}
