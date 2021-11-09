<?php


namespace Kizi\Core\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Kizi\Core\Libraries\Helpers;
use SwaggerLume\Generator;

class AppController extends Controller
{
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $folder = $request->input('folder') ?? 'tmp/'.Carbon::now()->format('Ymd');
            $file = Helpers::uploadFile($request->file('file'), $folder);
            return response_api($file);
        } else {
            throw new Exception('error');
        }
    }
}
