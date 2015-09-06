<?php namespace App\Commands;

use App\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SignUpNewUser extends Command implements ShouldBeQueued
{

    use InteractsWithQueue, SerializesModels;

    /**
     * @var string
     */
    protected $username;

    /**
     * Create a new command instance.
     *
     * @param $username
     * @param $email
     * @param $password
     */
    public function __construct($username, $email, $password)
    {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;

    }

}
