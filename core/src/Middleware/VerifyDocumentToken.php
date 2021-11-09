<?php

namespace Kizi\Core\Middleware;

use Closure;

class VerifyDocumentToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = $request->input('token');
            if ($token) {
                app('session')->put(['document_token' => $token]);
            }

            $token = app('session')->get('document_token', null);
            if (env('APP_DEBUG') || $token === config('app.document_token')) {
                return $next($request);
            }
        } catch (\Exception $e) {
        }
        abort(404);
    }
}
