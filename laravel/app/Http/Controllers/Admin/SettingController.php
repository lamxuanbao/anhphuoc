<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = app('setting');
        return view('admin.pages.setting',compact('settings'))->withTitle('Cấu hình');
    }

    public function update(UpdateSettingRequest $request)
    {
        dd(12);
        setting($request->except('_token', '_method'));
        return redirect()->route('admin.setting');
    }
}
