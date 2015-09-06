<?php namespace App\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard as Authenticator;

class LoginSiteUser extends Command implements SelfHandling
{

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the command.
     *
     * @param Request       $request
     * @param Authenticator $auth
     *
     * @return bool
     */
    public function handle(Request $request, Authenticator $auth)
    {

        return $auth->attempt(
            $request->except(['_token', 'remember', 'login_user']),
            $request->get('remember')
        );
    }

}
