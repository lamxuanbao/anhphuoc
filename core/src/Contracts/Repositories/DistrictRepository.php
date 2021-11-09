<?php

namespace Kizi\Core\Contracts\Repositories;

use Kizi\Core\Contracts\RepositoryInterface;

interface DistrictRepository extends RepositoryInterface
{
    public function getList($params);
}
