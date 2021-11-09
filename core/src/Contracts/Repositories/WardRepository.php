<?php

namespace Kizi\Core\Contracts\Repositories;

use Kizi\Core\Contracts\RepositoryInterface;

interface WardRepository extends RepositoryInterface
{
    public function getList($params);
}
