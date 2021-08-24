<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

//        if ($request->input('token') !== 'hello'){
//            return redirect('home');
//        }
//        return $next($request);

        $response = $next($request);

        $response2 = 'Hello';
        if ($response instanceof JsonResponse){
            $response->setEncodingOptions(JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
        }
        return $response;
    }
}
