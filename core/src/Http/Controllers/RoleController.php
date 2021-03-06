<?php


namespace Kizi\Core\Http\Controllers;



use Kizi\Core\Contracts\Repositories\RoleRepository;

class RoleController extends Controller
{
    public function __construct(RoleRepository $repository)
    {
        $this->repository = $repository;
    }

    protected function validateStore()
    {
        $this->validation([
            'name' => [
                'required',
                'string',
            ],
        ]);
        parent::validateStore(); // TODO: Change the autogenerated stub
    }

    public function permissions()
    {
        return response_api(config('permissions'));
    }
}
