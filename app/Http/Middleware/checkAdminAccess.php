<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class checkAdminAccess
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
        $role = Auth::user()->Role->code;
        if ($role !== 'admin') {
            $message = 'sorry, not admin';
            $type = 'danger';
            return redirect('/home')->with($message, $message)->with('type', $type);
        }

        return $next($request);
    }
}
