<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class UserAuthenticated {
    public function handle($request, Closure $next) {
        if( Auth::check() ) {
            if ( Auth::user()->isAdmin() ) {
                return redirect(route('admin_dashboard'));
            } else if ( Auth::user()->isUser() ) {
                return $next($request);
            }
        }
        abort(404);
    }
}
