<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
                'integer',
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
        $params['is_active'] = $params['is_active'] ?? false;
        $property = new Property();
        $property->fill($params);
        $property->save();
        try {
            $images = $request->get('images_data');
            foreach ($images as &$item){
                $item = json_decode($item,true);
                Storage::move($item['path'], str_replace('tmp/','property/',$item['path']));
                $item['path'] = str_replace('tmp/','property/',$item['path']);
            }
            $property->images()
                ->createMany($images);
        }catch (\Exception $e){}

        return redirect()->route('admin.property');
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
                'integer',
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
        $params['is_active'] = $params['is_active'] ?? false;
        $property = Property::findOrFail($id);
        $property->fill($params);
        $property->save();
        try {
            $property->images()->delete();
            $images = $request->get('images_data');
            foreach ($images as &$item){
                $item = json_decode($item,true);
                if(strpos($item['path'], 'tmp/') !== false) {
                    Storage::move($item['path'], str_replace('tmp/', 'property/', $item['path']));
                    $item['path'] = str_replace('tmp/', 'property/', $item['path']);
                }
            }
            $property->images()
                ->createMany($images);
        }catch (\Exception $e){}

        return redirect()->route('admin.property');
    }

    public function destroy($id)
    {
        Property::destroy($id);

        return redirect()->route('admin.property');
    }
}
