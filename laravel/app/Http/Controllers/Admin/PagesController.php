<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $page_title = 'fontawesome';
        $page_description = 'This is fontawesome test page';

        return view('admin.pages.home', compact('page_title', 'page_description'));
    }
    public function login()
    {
        return view('admin.pages.login');
    }
}
