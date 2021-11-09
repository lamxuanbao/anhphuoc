<?php


namespace Kizi\Core\Http\Document;


use Illuminate\Http\Response;

class AssetController
{
    public function index($asset)
    {
        $pathInfo = str_replace('/document', '', request()->getPathInfo());
        $path = realpath(__DIR__.'/../../../resources/vendor').$pathInfo;
        return (new Response(
            file_get_contents($path), 200, [
                'Content-Type' => pathinfo($asset)['extension'] == 'css' ?
                    'text/css' : 'application/javascript',
            ]
        ))->setSharedMaxAge(31536000)
            ->setMaxAge(31536000)
            ->setExpires(new \DateTime('+1 year'));
    }
}
