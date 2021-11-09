<?php

namespace Kizi\Core\Contracts\Repositories;

use Kizi\Core\Contracts\RepositoryInterface;

interface RoleRepository extends RepositoryInterface
{
    public function getList($params);
}
