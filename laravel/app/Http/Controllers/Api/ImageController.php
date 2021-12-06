<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Libraries\Helpers;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'images' => 'array|required',
            'images.*' => 'file|mimes:jpeg,jpg,png,gif|required|max:50000',
        ]);

        $images = [];
        if ($request->hasfile('images')) {
            if(is_array($request->file('images'))) {
                foreach ($request->file('images') as $image) {
                    $images[] = Helpers::uploadFile($image, 'tmp');
                }
            }else{
                $images[] = Helpers::uploadFile($request->file('images'), 'tmp');
            }
        }
        return response()->json($images);
//        return back()->with('success', 'Images uploaded successfully');
    }
}
