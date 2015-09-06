<?php namespace App\Commands;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Auth\Guard as Authenticator;

class RegisterGuestUser extends Command implements SelfHandling
{
    /**
     * Create a new command instance.
     *
     * @param Authenticator $auth
     */
    public function __construct(Authenticator $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Execute the command.
     *
     * @param UserRequest $request
     */
    public function handle(UserRequest $request)
    {
        try {

            $user = User::create($request->all());

            $this->auth->login($user);

        } catch (Exception $e) {

        }

    }

}
