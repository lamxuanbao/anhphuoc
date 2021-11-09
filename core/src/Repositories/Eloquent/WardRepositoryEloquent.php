<?php

namespace Kizi\Core\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Kizi\Core\Contracts\Repositories\WardRepository;
use Kizi\Core\Repositories\BaseRepository;
use Kizi\Core\Models\Wards;

class WardRepositoryEloquent extends BaseRepository implements WardRepository
{
    public function model()
    {
        return Wards::class;
    }

    public function getList($params)
    {
        $query = $this->model->with('province', 'district');
        if (isset($params['sortField'])) {
            if (isset($params['sortOrder']) && in_array($params['sortOrder'], ['asc', 'desc'])) {
                $query = $query->OrderByTranslation($params['sortField'], $params['sortOrder']);
            } else {
                $query = $query->OrderByTranslation($params['sortField']);
            }
        }
        if (Auth::check()) {
//            $query = $query->where('id', '<>', Auth::user()->id);
        }
        $result = $this->paging(
            $query,
            $params
        );
        return $result;
    }

}
