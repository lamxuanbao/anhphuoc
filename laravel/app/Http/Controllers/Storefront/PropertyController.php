<?php


namespace App\Http\Controllers\Storefront;


use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers');
    }

    public function index()
    {
        $user     = auth('customers')->user();
        $property = Property::where(['customer_id' => $user->id])
                            ->orderBy('id')
                            ->paginate(15);

        return view('storefront.pages.property.index', compact('property'))->withTitle(setting('title'));
    }

    public function create()
    {
        $property = new Property();

        return view('storefront.pages.property.create', compact('property'))->withTitle('Tạo bất động sản');
    }

    public function store(Request $request)
    {
        Validator::make(
            $request->all(),
            [
                'title'       => [
                    'required',
                ],
                'address'     => [
                    'required',
                ],
                'area'        => [
                    'required',
                    'integer',
                ],
                'type'        => [
                    'required',
                    'in:buy,rent',
                ],
                'price'       => [
                    'required',
                    'integer',
                ],
                'is_active'   => [
                    'boolean',
                ],
                'province_id' => [
                    'required',
                ],
                'content'     => [
                    'required',
                ],
                'images_data' => [
                    'required',
                ],
            ]
        )
                 ->validate();
        $params              = $request->except('_token', '_method');
        $user                = auth('customers')->user();
        $params->customer_id = $user->id;
        $property            = new Property();
        $property->fill($params);
        $property->save();
        try {
            $images = $request->get('images_data');
            foreach ($images as &$item) {
                $item = json_decode($item, true);
                Storage::move($item['path'], str_replace('tmp/', 'property/', $item['path']));
                $item['path'] = str_replace('tmp/', 'property/', $item['path']);
            }
            $property->images()
                     ->createMany($images);
        } catch (\Exception $e) {
        }

        return redirect()->route('auth.property');
    }


    public function destroy($id)
    {
        $user     = auth('customers')->user();
        $property = Property::where(['id' => $id, 'customer_id' => $user->id])
                            ->firstOrFail();
        $property->delete();

        return redirect()->route('auth.property');
    }
}
