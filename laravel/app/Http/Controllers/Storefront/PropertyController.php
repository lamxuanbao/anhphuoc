<?php


namespace App\Http\Controllers\Storefront;


use App\Http\Controllers\Controller;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:customers');
    }

    public function index()
    {
        $user = auth('customers')->user();
        return view('storefront.pages.property.index', compact('user'))->withTitle(setting('title'));
    }
}
