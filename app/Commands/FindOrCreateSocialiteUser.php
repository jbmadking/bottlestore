<?php namespace App\Commands;

use App\Repositories\User;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Auth\Guard as Authenticator;

/**
 * Class FindOrCreateSocialiteUser
 *
 * @package App\Commands
 */
class FindOrCreateSocialiteUser extends Command implements SelfHandling
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * @var array
     */
    protected $allowedProviders = [
        'github',
        'linkedin',
        'google',
        'facebook',
        'twitter'
    ];

    /**
     * Create a new command instance.
     *
     * @param                                  $provider
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct($provider, Authenticator $auth)
    {
        $this->auth = $auth;
        $this->provider = $provider;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        if (in_array($this->provider, $this->allowedProviders)) {

            $user = User::findByUserNameOrCreate(Socialite::with($this->provider)->user());

            $this->auth->login($user);
        }
    }

}
