<?php
/**
 * Created by PhpStorm.
 * User: nhockizi
 * Date: 8/1/21
 * Time: 14:07
 */

namespace App\Repositories;


use App\Models\Properties;
use App\Models\PropertyImages;
use Illuminate\Support\Facades\Auth;
use Kizi\Core\Libraries\Helpers;
use Kizi\Core\Repositories\BaseRepository;

class PropertyImageRepository extends BaseRepository
{
    public function model()
    {
        return PropertyImages::class;
    }
}
