<?php


namespace Kizi\Core\Http\Controllers;

use Kizi\Core\Contracts\Repositories\DistrictRepository;

class DistrictController extends Controller
{
    public function __construct(DistrictRepository $repository)
    {
        $this->repository = $repository;
    }
}
