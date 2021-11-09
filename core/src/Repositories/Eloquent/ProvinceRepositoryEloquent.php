<?php

namespace Kizi\Core\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;
use Kizi\Core\Contracts\Repositories\ProvinceRepository;
use Kizi\Core\Repositories\BaseRepository;
use Kizi\Core\Models\Provinces;

class ProvinceRepositoryEloquent extends BaseRepository implements ProvinceRepository
{
    public function model()
    {
        return Provinces::class;
    }

    public function getList($params)
    {
        $query = $this->model;
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
