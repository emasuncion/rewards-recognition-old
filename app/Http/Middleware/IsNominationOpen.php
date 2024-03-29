<?php

namespace App\Http\Middleware;

use Closure;

class IsNominationOpen
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
        if (auth()->user()->nominationOpen()) {
            return $next($request);
        }
        return redirect('admin');
    }
}
