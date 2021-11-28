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
        $property = Property::orderBy('id')
                             ->paginate(15);

        return view('admin.pages.property.index', compact('property'))->withTitle('Danh sách bất động sản');
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

    public function edit($id)
    {
        $property = Property::findOrFail($id);

        return view('admin.pages.property.update', compact('property'))->withTitle('Chỉnh sửa bất động sản');
    }

    public function update($id, Request $request)
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
        Property::findOrFail($id)->update($request->except('_token', '_method'));

        return redirect()->route('admin.property');
    }

    public function destroy($id)
    {
        Property::destroy($id);

        return redirect()->route('admin.property');
    }
}
