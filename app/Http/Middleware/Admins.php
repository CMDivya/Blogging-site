<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admins
{
public function handle($request, Closure $next)
    {
        if(Auth::user()->type == 'admin'){
            redirect()->route('category.index');
            return $next($request);
        } else {
            abort(404);
        }
    }
}