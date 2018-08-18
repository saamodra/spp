<?php

namespace App\Http\Middleware;

use Illuminate\Contracts\Auth\Guard;
use Auth;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    public function handle($request, Closure $next)
    {
       if (Auth::user()->level !== "admin") {
            echo '<script type="text/javascript">alert("User tidak diizinkan mengakses halaman ini!");</script>';
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
