<?php

namespace Kizi\Core\Contracts\Repositories;

use Kizi\Core\Contracts\RepositoryInterface;

interface SettingRepository extends RepositoryInterface
{
    public function getList($request);
}
