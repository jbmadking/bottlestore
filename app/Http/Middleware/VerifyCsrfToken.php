<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * @var array Protected routes
     */
    protected $openRoutes = ['payment/notify'];

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
        foreach ($this->openRoutes as $openRoute) {

            if ($request->is($openRoute)) {

                return $next($request);
            }
        }

        return parent::handle($request, $next);
    }

}
