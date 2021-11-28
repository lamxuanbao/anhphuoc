<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function index()
    {
        $customers = Property::orderBy('id')
                             ->paginate(15);

        return view('admin.pages.property.index', compact('customers'))->withTitle('Danh sách bất động sản');
    }

    public function create()
    {
        $property = new Property();

        return view('admin.pages.property.create', compact('property'))->withTitle('Tạo bất động sản');
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title'    => [
                'required',
            ],
            'address'    => [
                'required',
            ],
            'area'    => [
                'required',
            ],
            'type'    => [
                'required',
                'in:buy,rent'
            ],
            'price'    => [
                'required',
                'integer'
            ],
            'is_active'    => [
                'boolean',
            ],
            'province_id'    => [
                'required',
            ],
            'content'    => [
                'required',
            ]
        ])->validate();
        $params = $request->except('_token', '_method');
        dd($params);
    }
}
