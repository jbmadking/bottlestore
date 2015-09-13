<?php namespace App\Http\Controllers;

use App\Commands\FindOrCreateSocialiteUser;
use App\Http\Requests;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Auth\Guard as Authenticator;

class SocialiteController extends Controller
{
    /**
     * @param $provider
     *
     * @return
     */
    public function login($provider)
    {
        return Socialite::with($provider)->redirect();
    }

    function oAuthorise($provider, Authenticator $auth)
    {
        $this->dispatch(new FindOrCreateSocialiteUser($provider, $auth));

        return redirect('user/dashboard');
    }

}
