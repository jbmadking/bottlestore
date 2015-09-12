<?php namespace App\Commands;

use App\Events\NewUserAddressAdded;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Support\Facades\Auth;

/**
 * Class SaveUserAddresses
 *
 * @package App\Commands
 */
class SaveUserAddresses extends Command implements SelfHandling
{
    /**
     * @var
     */
    protected $billingAddress;

    /**
     * Create a new command instance.
     *
     * @param $billingAddress
     */
    public function __construct($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        $billingAddress = array_filter($this->billingAddress);

        if (!empty($billingAddress)) {

            Auth::user()->addresses()->create($this->request->get('billing'));
        }

        event(new NewUserAddressAdded());
    }
}
