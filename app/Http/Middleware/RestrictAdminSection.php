<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use Laracasts\Flash\Flash;

class RestrictAdminSection
{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard $auth
     *
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!$this->auth->check()) {

            flash()->message('Please Log In.');

            return new RedirectResponse(url('auth/login'));
        }

        if (!$this->auth->user()->is_admin) {

            flash()->message('Restricted Access!!!');

            return new RedirectResponse(url('user/dashboard'));
        }

        return $next($request);
    }

}
