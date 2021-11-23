<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Property;

class PropertyController extends Controller
{
    public function index()
    {
        $customers = Property::orderBy('id')->paginate(15);

        return view('admin.pages.property.index', [
            'customers' => $customers
        ])->withTitle('Danh sách bất động sản');
    }

    public function create(){
        return view('admin.pages.property.create')->withTitle('Tạo bất động sản');
    }
}
