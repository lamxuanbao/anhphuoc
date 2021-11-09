<?php


namespace Kizi\Core\Http\Controllers;

use Kizi\Core\Contracts\Repositories\ProvinceRepository;

class ProvinceController extends Controller
{
    public function __construct(ProvinceRepository $repository)
    {
        $this->repository = $repository;
    }
}
