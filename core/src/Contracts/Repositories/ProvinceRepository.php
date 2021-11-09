<?php

namespace Kizi\Core\Contracts\Repositories;

use Kizi\Core\Contracts\RepositoryInterface;

interface ProvinceRepository extends RepositoryInterface
{
    public function getList($params);
}
