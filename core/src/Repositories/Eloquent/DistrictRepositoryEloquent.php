<?php

namespace Kizi\Core\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Kizi\Core\Contracts\Repositories\DistrictRepository;
use Kizi\Core\Models\Districts;
use Kizi\Core\Repositories\BaseRepository;

class DistrictRepositoryEloquent extends BaseRepository implements DistrictRepository
{
    public function model()
    {
        return Districts::class;
    }

    public function getList($params)
    {
        $query = $this->model->with('province');
        if (isset($params['sortField'])) {
            if (isset($params['sortOrder']) && in_array($params['sortOrder'], ['asc', 'desc'])) {
                $query = $query->OrderByTranslation($params['sortField'], $params['sortOrder']);
            } else {
                $query = $query->OrderByTranslation($params['sortField']);
            }
        } else {
            $query = $query->orderBy('id');
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
