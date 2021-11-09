<?php


namespace Kizi\Core\Http\Document;


use Illuminate\Http\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class SwaggerController
{
    public $paths = [];

    public function __construct()
    {
        $this->paths = array_merge($this->paths(), config('swagger') ?? []);
    }

    public function index()
    {
        return view('core::document.swagger.index');
    }

    private function paths()
    {
        $routes = Route::getRoutes();
        $result = [];
        foreach ($routes as $route) {
            if ($route['uri'] != '/') {
                $method = strtolower($route['method']);
                $uri = explode('/', $route['uri']);
                unset($uri[0]);
                $tags = $uri[1] ?? 'default';

                $operationId = $method.'_'.implode(' ', $uri);
                $operationId = Str::of($operationId)->replace('{', '');
                $operationId = Str::of($operationId)->replace('}', '');
                $operationId = Str::of($operationId)->replace('-', '');
                $operationId = Str::of($operationId)->camel();
                $title = Str::of(Str::of($tags)->replace('-', ' '))->title();
                $result[$route['uri']] = [
                    $method => [
                        "tags" => [
                            $title
                        ],
                        "security" => [
                            [
                                "bearerAuth" => []
                            ]
                        ],
                        "parameters" => [],
                        "summary" => null,
                        "operationId" => $operationId,
                        "responses" => [
                            "200" => [
                                "description" => "[ 'status'=>true, 'message'=>null, 'data'=>[] ]"
                            ],
                            "401" => [
                                "description" => "[ 'status'=>false, 'message'=>'Invalid token', 'data'=>[] ]"
                            ]
                        ],
                    ]
                ];
            }
        }
        ksort($result);
        return $result;
    }

    public function manage()
    {
        return view('core::document.swagger.manage', [
            'data' => $this->paths
        ]);
    }

    public function detail($asset)
    {
        try {
            $asset = explode('@@@@@', Crypt::decrypt($asset));
            list($method, $uri) = $asset;
            return view('core::document.swagger.detail', [
                'uri' => $uri,
                'method' => $method,
                'data' => $this->paths[$uri][$method]
            ]);
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function data()
    {
        $swagger = [
            "openapi" => "3.0.0",
            "info" => [
                "title" => "Document Api",
                "license" => [
                    "name" => "MIT"
                ],
                "version" => "1.0.0"
            ],
            "host" => env('APP_URL'),
            "components" => [
                "securitySchemes" => [
                    "bearerAuth" => [
                        "type" => "http",
                        "scheme" => "bearer",
                        "bearerFormat" => "JWT",
                    ]
                ]
            ],
            "paths" => $this->paths
        ];
        return new Response(json_encode($swagger), 200, ['Content-Type' => 'application/json']);
    }
}
