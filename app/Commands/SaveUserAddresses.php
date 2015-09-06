<?php namespace App\Commands;

use App\Events\NewUserAddressAdded;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveUserAddresses extends Command implements SelfHandling
{
    protected $request;

    /**
     * Create a new command instance.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Execute the command.
     *
     */
    public function handle()
    {
        $shippingAddress = array_filter($this->request->get('shipping'));
        $billingAddress = array_filter($this->request->get('billing'));

        if (!empty($billingAddress)) {
            Auth::user()->addresses()->create($this->request->get('billing'));
        }

        if (!empty($shippingAddress)) {
            Auth::user()->addresses()->create($this->request->get('shipping'));
        }

        event(new NewUserAddressAdded());
    }

}
