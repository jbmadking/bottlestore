<?php namespace App\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Auth\Guard as Authenticator;

/**
 * Class LoginSiteUser
 *
 * @package App\Commands
 */
class LoginSiteUser extends Command implements SelfHandling
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Authenticator
     */
    private $auth;

    /**
     * Create a new command instance.
     *
     * @param Request       $request
     * @param Authenticator $auth
     */
    public function __construct(Request $request, Authenticator $auth)
    {
        $this->request = $request;
        $this->auth = $auth;
    }

    /**
     * Execute the command.
     *
     * @return bool
     */
    public function handle()
    {

        return $this->auth->attempt(
            $this->request->except(['_token', 'remember', 'login_user']),
            $this->request->get('remember')
        );
    }

}
