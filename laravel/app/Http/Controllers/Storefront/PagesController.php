<?php

namespace App\Http\Controllers\Storefront;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $property = Property::where('is_active', true)
                            ->take(10)
                            ->get();

        return view('storefront.pages.home', compact('property'))->withTitle(setting('title'));
    }

    public function area(Request $request)
    {
        $search = [
            'title'       => $request->get('title'),
            'price'       => $request->get('price'),
            'type'        => $request->get('type'),
            'province_id' => $request->get('province_id'),
            'area'        => $request->get('area'),
        ];
        if (!in_array($search['type'], ['buy', 'rent'])) {
            $search['type'] = null;
        }
        $property = Property::where('is_active', true);

        if (!is_null($search['title'])) {
            $property = $property->where('title', 'like', '%'.$search['title'].'%');
        }
        if (!is_null($search['type'])) {
            $property = $property->where('type', $search['type']);
        }
        if (!is_null($search['province_id'])) {
            $property = $property->where('province_id', $search['province_id']);
        }
        $property = $property->orderBy('id')
                             ->paginate(15);
        $property->appends($search)
                 ->links();

        return view('storefront.pages.area', compact('search', 'property'))->withTitle(setting('title'));
    }

    public function detail($slug){
        $property = Property::where('slug',$slug)->firstOrFail();
        return view('storefront.pages.detail', compact( 'property'))->withTitle($property->title);
    }
}
