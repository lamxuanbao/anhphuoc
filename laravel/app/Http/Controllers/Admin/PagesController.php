<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return redirect()->route('admin.property');
    }
}
