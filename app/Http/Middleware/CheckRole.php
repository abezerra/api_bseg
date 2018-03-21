<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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

        if(!Auth::check ())
        {
//            return redirect ('/api/authenticate');
//            return response()->json([
//                'code' => 401,
//                'error' => 'unauthorized',
//                'message' => 'unauthorized access'
//            ],
//                401);

        }
        return $next($request);
    }


}
