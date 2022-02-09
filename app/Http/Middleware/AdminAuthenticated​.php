<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class AdminAuthenticated{

    public function handle($request, Closure $next) {
        if( Auth::check() ) {
            if ( Auth::user()->isUser() ) {
                return redirect(route('user_dashboard'));
            } else if ( Auth::user()->isAdmin() ) {
                return $next($request);
            }
        }

        abort(404);
    }
}
