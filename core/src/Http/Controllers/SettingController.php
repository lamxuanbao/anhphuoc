<?php

namespace Kizi\Core\Http\Controllers;


use Illuminate\Http\Response;
use Kizi\Core\Models\Settings;

class SettingController extends Controller
{
    public function index()
    {
        $systems = config('settings.fields.systems') ?? [];
        $setting = setting();
        foreach ($systems as $item) {
            unset($setting[$item]);
        }
        return response_api($setting);
    }

    public function store()
    {
        Settings::setMany(request()->all());
        return response_api(
            Settings::allCached(),
            Response::HTTP_OK,
            __('core.actions.create_success')
        );
    }
//    public $validation = ContactRequest::class;
}
